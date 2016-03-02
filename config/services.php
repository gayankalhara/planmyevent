<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('mail.planmyevent.me'),
        'secret' => env('key-a4fa8d0084f56c1817f764e31fae7cf9'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id'     => '694991796270-fdqrf2d8aj0kmsu5qm6uj6ri64vg6cer.apps.googleusercontent.com',
        'client_secret' => '7Als8vhVF97uOok7uNJbjmUn',
        'redirect'      => 'http://www.planmyevent.me/auth/google/callback'
    ],

    'facebook' => [
        'client_id'     => '1072410062809779',
        'client_secret' => '86f1b03b9c679ffbd02f9d5f52699f55',
        'redirect'      => 'http://www.planmyevent.me/auth/facebook/callback'
    ]


];

 