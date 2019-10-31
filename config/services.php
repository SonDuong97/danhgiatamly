<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    //    'facebook' => [
    //        'client_id'     => '406560916545239',
    //        'client_secret' => '900f3ff34772213e977b7a2ecb71bbe6',
    //        'redirect'      => 'https://tuvanhoc.tk/auth/facebook/callback',
    //    ],

    //    'google' => [
    //        'client_id' => env('580499876821-9sgqnk0q2q1vdr15k4vm2460pt7lb684.apps.googleusercontent.com'),
    //        'client_secret' => env('cZDXSmsIyYKDK1Oo5NulsvyY'),
    //        'redirect' => env('https://tuvanhoc.tk/auth/google/callback'),
    //    ],
    'google' => [
        'client_id'     => env('G+_CLIENT_ID'),
        'client_secret' => env('G+_CLIENT_SECRET'),
        'redirect'      => env('G+_REDIRECT')
    ],

    'facebook' => [
        'client_id'     => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect'      => env('FB_REDIRECT')
    ],
];
