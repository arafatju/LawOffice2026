<?php

namespace App\Services;

use App\Models\SmsLog;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OssSms
{
    private const TOKEN_KEY = 'oss_sms_token';

    /** Notification SMS, logged and de-duplicated per transaction. */
    public function send(?string $mobile, string $message, ?string $trid = null, ?string $userid = null): bool
    {
        // Don't send twice for the same transaction
        if ($trid && SmsLog::where('trid', $trid)->where('status', 'sent')->exists()) {
            return true;
        }

        $destination = $this->normalize((string) $mobile);
        $status      = 'failed';
        $reason      = $destination ? '' : 'Invalid or missing mobile number';

        if ($destination) {
            try {
                $response = $this->post(config('services.oss_sms.sms_url'), [
                    'msg'         => $message,
                    'destination' => $destination,
                ]);

                $reason = trim($response->body());
                Log::info('OSS SMS response', ['to' => $destination, 'http' => $response->status(), 'body' => $reason]);

                if ($response->successful()) {
                    $status = 'sent';
                }
            } catch (\Throwable $e) {
                $reason = $e->getMessage();
                Log::error("OSS SMS failed for {$destination}: {$reason}");
            }
        }

        $this->log($trid, $userid, $destination, $message, $status, $reason);

        return $status === 'sent';
    }

    /** OTP SMS. $template is the message template the gateway fills the code into. */
    public function sendOtp(?string $mobile, string $template, int $length = 6): bool
    {
        $destination = $this->normalize((string) $mobile);
        if (! $destination) {
            return false;
        }

        try {
            $response = $this->post(config('services.oss_sms.otp_url'), [
                'msgTmp'      => $template,
                'destination' => $destination,
                'otpType'     => 'sms',
                'otpLength'   => $length,
            ]);

            Log::info('OSS OTP response', ['to' => $destination, 'http' => $response->status(), 'body' => $response->body()]);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::error("OSS OTP failed for {$destination}: " . $e->getMessage());
            return false;
        }
    }

    /** POST JSON with a bearer token; on 401, refresh the token once and retry. */
    protected function post(string $url, array $payload): Response
    {
        $call = fn () => Http::withToken($this->token())
            ->acceptJson()
            ->asJson()
            ->timeout(15)
            ->post($url, $payload);

        $response = $call();

        if ($response->status() === 401) {
            Cache::forget(self::TOKEN_KEY);
            $response = $call();
        }

        return $response;
    }

    /** Client-credentials token, cached until shortly before it expires. */
    protected function token(): string
    {
        if ($cached = Cache::get(self::TOKEN_KEY)) {
            return $cached;
        }

        $res = Http::asForm()->timeout(15)->retry(2, 500)->post(config('services.oss_sms.token_url'), [
            'grant_type'    => 'client_credentials',
            'client_id'     => config('services.oss_sms.client_id'),
            'client_secret' => config('services.oss_sms.client_secret'),
        ]);

        $token = $res->json('access_token');
        if (! $token) {
            throw new \RuntimeException('OSS token request failed: ' . Str::limit($res->body(), 200, ''));
        }

        Cache::put(self::TOKEN_KEY, $token, max(30, (int) $res->json('expires_in', 300) - 60));

        return $token;
    }

    protected function log(?string $trid, ?string $userid, ?string $destination, string $message, string $status, string $reason): void
    {
        try {
            SmsLog::create([
              
                'trid'     => $trid,
                'userid'   => $userid,
                'mobile'   => Str::limit($destination ?: 'invalid', 20, ''),
                'message'  => $message,
                'status'   => $status,
                'response' => Str::limit($reason, 500, ''),
                'sent_at'  => $status === 'sent' ? now() : null,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to store SMS log: ' . $e->getMessage());
        }
    }

    protected function normalize(string $raw): ?string
{
    $n = preg_replace('/\D/', '', $raw);

    // 8801XXXXXXXXX -> 01XXXXXXXXX
    if (str_starts_with($n, '880') && strlen($n) === 13) {
        $n = substr($n, 2);
    }

    // 1XXXXXXXXX -> 01XXXXXXXXX
    if (strlen($n) === 10 && str_starts_with($n, '1')) {
        $n = '0' . $n;
    }

    return preg_match('/^01[3-9]\d{8}$/', $n) ? $n : null;
}
}