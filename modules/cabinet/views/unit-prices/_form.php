<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UnitPrices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-prices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unit_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_value')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('price', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
