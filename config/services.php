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

    'facebook' => [
        'client_id' => '255193529646682', 
        'client_secret' => 'b7d56e404b23f9fad80ca9759175f46d',
        'redirect' => 'http://localhost:8000/facebook/callback/'
    ],

    
    'google' => [
        'client_id' => '640150878670-lsjg59dj3ksousoh8cjm3rbebebefbe2.apps.googleusercontent.com', 
        'client_secret' => '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', 
        // 'redirect' => 'https://vietseedsportal.opsgreat.vn/google/callback/'
        // 'redirect' => 'https://platform.vietseeds.org/google/callback/'
        'redirect' => 'http://localhost:8000/google/callback/'
    ],
    
   /*  'google' => [
        'client_id' => '940575810479-844tl7uh34ggh7ghd3qi1a771s9d22p7.apps.googleusercontent.com', 
        'client_secret' => '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', 
        'redirect' => 'http://localhost:8000/google/callback/mentor/'
    ], */
];
