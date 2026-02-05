<?php

return [
    'max_attempts' => env('LOGIN_RATE_LIMIT_MAX_ATTEMPTS', 5),
    'decay_minutes' => env('LOGIN_RATE_LIMIT_DECAY_MINUTES', 5),
];