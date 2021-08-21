<?php

use yii\helpers\Html;

\app\assets\CabinetAsset::register($this);
$this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <?php $this->registerCsrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?> &bull; </title>
    <?php $this->head(); ?>

</head>

<body data-sidebar="dark">
    <?php $this->beginBody(); ?>
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?= \app\modules\cabinet\widgets\HeaderWidget::widget(); ?>

        <?= \app\modules\cabinet\widgets\SidebarWidget::widget(); ?>


                    <?= $content ?>

            <?= \app\modules\cabinet\widgets\FooterWidget::widget(); ?>


    <?php $this->endBody(); ?>

</body>

</html>
<?php $this->endPage(); ?>