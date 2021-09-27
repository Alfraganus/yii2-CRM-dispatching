<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TodayBoardStatus */

$this->title = Yii::t('broker', 'Create Today Board Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('broker', 'Today Board Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="today-board-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
