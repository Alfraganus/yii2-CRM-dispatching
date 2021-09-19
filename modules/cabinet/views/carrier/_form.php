<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cariers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cariers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'carrier_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carrier_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('carrier', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
