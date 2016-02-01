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
        'client_id'     => env('694991796270-fdqrf2d8aj0kmsu5qm6uj6ri64vg6cer.apps.googleusercontent.com'),
        'client_secret' => env('88b6ZcwnVFCRobbgJwTL3O3f'),
        'redirect'      => env('http://www.planmyevent.me/social/handle/google')
    ],


];

 