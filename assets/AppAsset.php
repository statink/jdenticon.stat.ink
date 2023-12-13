<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;

final class AppAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';

    /**
     * @var string
     */
    public $baseUrl = '@web';

    /**
     * @var class-string<AssetBundle>[]
     */
    public $depends = [];
}
