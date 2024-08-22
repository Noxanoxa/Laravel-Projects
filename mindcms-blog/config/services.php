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

//        'client_id' => env('FACEBOOK_CLIENT_ID'),
//        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'facebook' => [
        'client_id' => '511828781396811',
        'client_secret' => 'bb49f4ee258616cc3fe09cb87cdea4bb',
        'redirect' => 'https://bloggi.test/login/facebook/callback',
    ],

/* must have real authorised domain such as .com .net ...
  'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('https://bloggi.test/login/google/callback'),
    ],*/

    'twitter' => [
        'client_id' => 'XPX5bNN6VHS5s65cisLV3YCy6',
        'client_secret' => 'PPAOvgDd3BNxXqAvKu6tAi6XwJ1vzSI0saq8Pd1PyG3ZiehQ04',
        'redirect' => 'https://bloggi.test/login/twitter/callback',
    ],


];
