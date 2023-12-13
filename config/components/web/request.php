<?php

declare(strict_types=1);

return [
    'cookieValidationKey' => trim(file_get_contents(__DIR__ . '/request/cookie-validation-key.txt')),
];
