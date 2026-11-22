<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |

    'teletalk' => [
    'url'  => env('TELETALK_URL'),
    'user' => env('TELETALK_USER'),
    'pass' => env('TELETALK_PASS'),
],
  

*/
'oss_sms' => [
    'token_url'     => env('OSS_SMS_TOKEN_URL'),
    'client_id'     => env('OSS_SMS_CLIENT_ID'),
    'client_secret' => env('OSS_SMS_CLIENT_SECRET'),
    'sms_url'       => env('OSS_SMS_URL', 'https://api-k8s.oss.net.bd/api/broker-service/sms/send_sms'),
    'otp_url'       => env('OSS_OTP_URL', 'https://api-k8s.oss.net.bd/api/broker-service/otp/send_otp'),
    'site'          => env('SMS_SITE', env('APP_NAME')),
],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'recaptcha' => [
     
    'secret' => env('6LfzaokqAAAAAKJZ2GYWPwaPjDeKPxWKcdKX1ae3'),
    'sitekey' => env('6LfzaokqAAAAAC7oGTEbUZSewrf99Dp7F8E7ZTcx'),
],


];
