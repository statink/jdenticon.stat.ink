<?php

declare(strict_types=1);

return [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        require __DIR__ . '/log/file-target.php',
    ],
];
