<?php

declare(strict_types=1);

namespace app\controllers;

use Override;
use app\actions\jdenticon\GenerateAction;
use yii\web\Application;
use yii\web\Controller;

/**
 * @extends Controller<Application>
 */
final class JdenticonController extends Controller
{
    /**
     * @inheritdoc
     */
    #[Override]
    public function actions()
    {
        return [
            'generate' => GenerateAction::class,
        ];
    }
}
