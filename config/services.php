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
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // SMS gateway configuration for Tigula notifications
    'sms' => [
        'enabled' => env('SMS_ENABLED', false),
        'provider' => env('SMS_PROVIDER', 'http'), // 'twilio', 'http', or 'zamtel'
        'sender_id' => env('SMS_SENDER_ID', 'Uplift'),

        // Generic HTTP gateway
        'gateway_url' => env('SMS_GATEWAY_URL'),
        'api_key' => env('SMS_API_KEY'),

        // Zamtel SMS specific settings (Zambia)
        'zamtel' => [
            'api_key' => env('ZAMTEL_SMS_API_KEY'),
            'sender_id' => env('ZAMTEL_SMS_SENDER_ID', 'Uplift'),
            'gateway_url' => env('SMS_GATEWAY_URL', 'https://bulksms.zamtel.co.zm/api/v2.1/action/send'),
        ],

        // Twilio configuration
        'twilio' => [
            'sid' => env('TWILIO_SID'),
            'token' => env('TWILIO_TOKEN'),
            'from' => env('TWILIO_FROM'), // Your Twilio phone number
        ],
    ],

];
