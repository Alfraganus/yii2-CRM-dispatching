<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Loads */

$this->title = Yii::t('loads', 'Update Loads: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('loads', 'Loads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('loads', 'Update');
?>
<div class="loads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
