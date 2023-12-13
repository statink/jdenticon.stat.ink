<?php

declare(strict_types=1);

use yii\debug\Module as DebugModule;

$config = [
    'id' => 'jdenticon',
    'language' => 'en-US',
    'timeZone' => 'UTC',
    'charset' => 'UTF-8',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'cache' => require __DIR__ . '/components/cache.php',
        'db' => require __DIR__ . '/components/db.php',
        'errorHandler' => require __DIR__ . '/components/web/error-handler.php',
        'log' => require __DIR__ . '/components/log.php',
        'request' => require __DIR__ . '/components/web/request.php',
        'urlManager' => require __DIR__ . '/components/web/url-manager.php',
        'user' => require __DIR__ . '/components/web/user.php',
    ],
    'params' => require __DIR__ . '/params.php',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => DebugModule::class,
        'allowedIPs' => [
            '127.0.0.0/8',
            '10.0.0.0/8',
            '172.16.0.0/12',
            '192.168.0.0/16',
            '::1',
        ],
    ];
}

return $config;
