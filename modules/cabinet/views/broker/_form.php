<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brokers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brokers-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'broker_name')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-6">
            <?= $form->field($model, 'broker_address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'broker_phone')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'broker_fax')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'broker_email')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'mc')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="alert alert-info">
        <strong><center>Broker contact person info</center></strong>
    </div>



    <div class="row">
        <div class="col-md-6">
              <?= $form->field($model, 'phone_direct_line')->textInput(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
              <?= $form->field($model, 'cell_phone')->textInput(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'phone')->textInput(['rows' => 6]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'phone_extention')->textInput(['rows' => 6]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['rows' => 6]) ?>
        </div>

    </div>







    <div class="form-group">
        <?= Html::submitButton(Yii::t('broker', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
