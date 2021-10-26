<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\LoadsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loads-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'broker_id') ?>

    <?= $form->field($model, 'load_id') ?>

    <?= $form->field($model, 'po_number') ?>

    <?php // echo $form->field($model, 'commodity') ?>

    <?php // echo $form->field($model, 'loaded_mile') ?>

    <?php // echo $form->field($model, 'total_rate') ?>

    <?php // echo $form->field($model, 'upload_rate_confirm') ?>

    <?php // echo $form->field($model, 'upload_bol') ?>

    <?php // echo $form->field($model, 'is_assigned') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('loads', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('loads', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
