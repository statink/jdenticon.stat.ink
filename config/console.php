<?php

declare(strict_types=1);

use yii\debug\Module as DebugModule;

$config = [
    'id' => 'jdenticon-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => require __DIR__ . '/components/cache.php',
        'db' => require __DIR__ . '/components/db.php',
        'log' => require __DIR__ . '/components/log.php',
    ],
    'params' => require __DIR__ . '/params.php',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => DebugModule::class,
    ];
}

return $config;
