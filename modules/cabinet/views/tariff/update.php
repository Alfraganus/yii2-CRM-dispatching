<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tariffs */

$this->title = Yii::t('tariff', 'Update Tariffs: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tariff', 'Tariffs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tariff', 'Update');
?>
<div class="tariffs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
