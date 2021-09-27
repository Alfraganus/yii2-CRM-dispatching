<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TodayBoardStatus */

$this->title = Yii::t('broker', 'Update Today Board Status: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('broker', 'Today Board Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('broker', 'Update');
?>
<div class="today-board-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
