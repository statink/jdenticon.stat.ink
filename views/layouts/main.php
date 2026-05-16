<?php

declare(strict_types=1);

use app\helpers\TypeHelper;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var string $content
 */

$this->registerMetaTag(['charset' => TypeHelper::app(Yii::$app)->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Html::encode(TypeHelper::app(Yii::$app)->language) ?>">
  <head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); echo "\n" ?>
  </head>
  <body>
<?php $this->beginBody() ?>
    <main id="main" role="main">
      <?= $content ?><?= "\n" ?>
    </main>
<?php $this->endBody(); echo "\n" ?>
  </body>
</html>
<?php $this->endPage(); echo "\n" ?>
