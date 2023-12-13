<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

declare(strict_types=1);

use yii\web\Application;

if (
    !file_exists(__DIR__ . '/../REVISION') &&
    !file_exists(__DIR__ . '/../.production')
) {
    define('YII_DEBUG', true);
    define('YII_ENV', 'dev');
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

(new Application(require __DIR__ . '/../config/web.php'))->run();
