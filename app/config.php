<?php

require_once '../vendor/autoload.php';
use Hybridauth\Provider\Google;

const GOOGLE_CLIENT_ID = '702613043671-fdvarp1amck5kjuuaqvh0kd71isillq6.apps.googleusercontent.com';
const GOOGLE_CLIENT_SECRET = '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';

$config = [
    'callback' => 'https://pagesactus.fr/googlsheet/callback',
    'keys' => [
        'id' => GOOGLE_CLIENT_ID,
        'secret' => GOOGLE_CLIENT_SECRET
    ],
    'scope' => 'https://www.googleapis.com/auth/spreadsheets',
    'authorize_url_parameters' => [
    'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
    'access_type' => 'offline'
    ]
];

$adapter = new Hybridauth\Provider\Google($config);