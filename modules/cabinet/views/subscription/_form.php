<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subscriptions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscriptions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tariff_id')->textInput() ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'subscription_start_date')->textInput() ?>

    <?= $form->field($model, 'subscription_end_date')->textInput() ?>

    <?= $form->field($model, 'overall_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('subscriptions', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
