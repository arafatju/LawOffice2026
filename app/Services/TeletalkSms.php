<?php 
namespace App\Services;

use App\Models\SmsLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TeletalkSms
{
    public function send(string $mobile, string $message, ?string $trid = null, ?string $userid = null): bool
    {
        // Don't send twice for the same transaction
        if ($trid && SmsLog::where('trid', $trid)->where('status', 'sent')->exists()) {
            return true;
        }

        $mobile = $this->normalize($mobile);
        $status = 'failed';
        $reason = 'Invalid number format';

        if ($mobile) {
            try {
                $response = Http::timeout(15)->retry(2, 500)->get(config('services.teletalk.url'), [
                    'op'      => 'SMS',
                    'user'    => config('services.teletalk.user'),
                    'pass'    => config('services.teletalk.pass'),
                    'mobile'  => $mobile,
                    'charset' => 'UTF-8',
                    'sms'     => $message,
                ]);

                $reason = trim($response->body());
                if ($this->isSuccess($response)) {
                    $status = 'sent';
                }
            } catch (\Throwable $e) {
                $reason = $e->getMessage();
                \Log::error("Teletalk SMS failed for {$mobile}: " . $reason);
            }
        }

        try {
            SmsLog::create([
                'trid'     => $trid,
                'userid'   => $userid,
                'mobile'   => Str::limit((string) ($mobile ?: 'invalid'), 20, ''),
                'message'  => $message,
                'status'   => $status,
                'response' => Str::limit($reason, 500, ''),
                'sent_at'  => $status === 'sent' ? now() : null,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Failed to store SMS log: ' . $e->getMessage());
        }

        return $status === 'sent';
    }

    /** ADJUST to your real Teletalk response */
    protected function isSuccess($response): bool
    {
        if (!$response->successful()) {
            return false;
        }
        $body = strtolower($response->body());
        return str_contains($body, 'sent') || str_contains($body, 'success');
    }

    protected function normalize(string $raw): ?string
    {
        $n = preg_replace('/\D/', '', $raw);

        if (str_starts_with($n, '01') && strlen($n) === 11) {
            $n = '88' . $n;
        }

        return preg_match('/^8801[3-9]\d{8}$/', $n) ? $n : null;
    }
}