<?php

declare(strict_types=1);

namespace app\controllers;

use app\actions\jdenticon\GenerateAction;
use yii\web\Controller;

final class JdenticonController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'generate' => GenerateAction::class,
        ];
    }
}
