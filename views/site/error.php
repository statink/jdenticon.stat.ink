<?php

declare(strict_types=1);

use yii\helpers\Html;
use yii\web\View;

/**
 * @var Exception $exception
 * @var View $this
 * @var string $message
 * @var string $name
 */

$this->title = $name;

?>
<div class="site-error">
  <h1><?= Html::encode($this->title) ?></h1>
  <div class="alert alert-danger">
    <?= nl2br(Html::encode($message)) . "\n" ?>
  </div>
</div>
