<?php

return [
    'siteKey' => env('INVISIBLE_RECAPTCHA_SITEKEY'),
    'secretKey' => env('INVISIBLE_RECAPTCHA_SECRETKEY'),
    'options' => [
        'hideBadge' => env('INVISIBLE_RECAPTCHA_BADGEHIDE', false),
        'dataBadge' => env('INVISIBLE_RECAPTCHA_DATABADGE', 'bottomright'),
        'timeout' => env('INVISIBLE_RECAPTCHA_TIMEOUT', 5),
        'debug' => env('INVISIBLE_RECAPTCHA_DEBUG', false)
    ]
];
