<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Drivers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drivers-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userModel, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'driver_fullname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userModel, 'password_hash')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($userModel, 'retypePassword')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'carrier_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\Cariers::findAll(['status'=>\app\models\Cariers::ACTIVE,'company_id'=>company_info()->id]),'id','carrier_name')
    ) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('driver', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
