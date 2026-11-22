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

     /*

      <?php

    function getAccessToken($expiresAt) {
        if (time() >= $expiresAt) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://idp.oss.net.bd/auth/realms/dev/protocol/openid-connect/token");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'grant_type' => 'client_credentials',
                'client_id' => 'law-ministry',
                'client_secret' => 'KA0biHXjDx017e1XXbTr4M1EyCK4158F'
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $tokenData = json_decode($response, true);
            if (isset($tokenData['access_token'])) {
                // Store new access token, refresh token, and expiry time
                // access_token can be generated for each sms or, can be stored and re-used for multiple sms
                return [
                    'access_token' => $tokenData['access_token'],
                    //'refresh_token' => $tokenData['refresh_token'] ?? $storedRefreshToken, // Refresh token might not always be returned
                    'expires_at' => time() + $tokenData['expires_in']
                ];
            } else {
                // Handle refresh token failure
                throw new Exception("Failed to refresh access token.");
            }
        }
        return ['access_token' => $storedAccessToken, 'expires_at' => $expiresAt];
    }


    public function send_sms($type='',$phone='',$message='',$origin=''){
        try {
          if($phone !== ''){
            $tokenInfo = $this->getAccessTokenAlt((time() - 3600));
            $accessToken = $tokenInfo['access_token'];
            $curl = curl_init();
            if($type == 'otp'){
                $url = 'https://api-k8s.oss.net.bd/api/broker-service/otp/send_otp';
                $post_fields = '{
                        "msgTmp": "From login OTP for eBailbond is: $code",
                        "destination": "'.$phone.'",
                        "otpType":"sms",
                        "otpLength":6
                    }';
            } else if($type == 'notification'){
                $url = 'https://api-k8s.oss.net.bd/api/broker-service/sms/send_sms';
                $post_fields = '{
                                    "msg": "'.$message.'",
                                    "destination": "'.$phone.'"
                                }';
            }

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>$post_fields,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accessToken
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response_json = json_encode($response,JSON_UNESCAPED_UNICODE);
            $response_arr = json_decode($response_json,true);
            $response_arr = json_decode($response_arr,true);
            
            return $response;
          } else {
            echo 'OFF';
          }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

**/

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