<?php

declare(strict_types=1);

namespace app\controllers;

use Override;
use yii\web\Application;
use yii\web\Controller;
use yii\web\ErrorAction;

/**
 * @extends Controller<Application>
 */
final class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    #[Override]
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }
}
