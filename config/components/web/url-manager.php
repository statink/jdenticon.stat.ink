<?php

declare(strict_types=1);

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '<hash:[0-9a-f]{32,}>.<ext:png|svg>' => 'jdenticon/generate',
    ],
];
