<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnitPrices */

$this->title = Yii::t('price', 'Update Unit Prices: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('price', 'Unit Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('price', 'Update');
?>
<div class="unit-prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
