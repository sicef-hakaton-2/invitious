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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
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
    'facebook' => [
        'client_id' => '552398844918386',
        'client_secret' => '3be8111ad512f001fbd1547759d98441',
        'redirect' => 'http://brunchhubtest.com/login/facebook/check',
    ],
    'paypal' => [
        'client_id' => 'AcLCg_yi2mDIvZ0mA-sqlXYRb5AUcIEtbnza9AC_eqQ9rb16yCPGlyw3kAvkhOxlkIQfsDkj3cJYZ0yh',
        'secret' => 'EMe-L-WmCuQuA3nqDHgYicXIENfMTBwsjzeQr0-bxTu_uq0gy-TWHyFgFle6gfYehuwBrqtLM8PEwKq6'
    ],

];
