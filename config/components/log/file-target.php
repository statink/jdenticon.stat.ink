<?php

declare(strict_types=1);

use yii\log\FileTarget;

return [
    'class' => FileTarget::class,
    'levels' => [
        'error',
        'warning',
    ],
];
