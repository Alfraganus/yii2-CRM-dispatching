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

    <div id="preloader">
        <div id="preloader-in">
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?= \app\modules\cabinet\widgets\HeaderWidget::widget(); ?>

        <!-- Left Sidebar Start -->
        <?= \app\modules\cabinet\widgets\SidebarWidget::widget(); ?>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="main-content">
            <div class="page-content">
                <div class="content-header">
                    <?php //$this->render('breadcrumb.php'); ?>
                </div>

                <div class="container-fluid">
                    <?= $content ?>
                </div>
            </div>

            <?= \app\modules\cabinet\widgets\FooterWidget::widget(); ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php $this->endBody(); ?>

</body>

</html>
<?php $this->endPage(); ?>