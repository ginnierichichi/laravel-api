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

    'tmdb' => [
        'key' => env('TMDB_KEY'),
        'now' => env('TMDB_NOW'),
        'details' => env('TMDB_DETAILS'),
        'genre' => env('TMDB_GENRE'),
        'search'=>env('TMDB_SEARCH'),
        'people'=>env('TMDB_PEOPLE'),
        'tv'=>env('TMDB_TV'),
        'top'=>env('TMDB_TOP'),
        'list'=>env('TMDB_LIST'),
    ],
];
