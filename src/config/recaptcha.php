<?php 

return [
    'site_key' => env('RECAPTCHA_SITE_KEY'),
    'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    'enabled' => env('RECAPTCHA_ENABLED', false),
    'min_score' => env('RECAPTCHA_MIN_SCORE', 0.5),
];
