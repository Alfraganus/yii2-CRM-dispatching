<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SubscriptionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscriptions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tariff_id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'subscription_start_date') ?>

    <?= $form->field($model, 'subscription_end_date') ?>

    <?php // echo $form->field($model, 'overall_price') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('subscriptions', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('subscriptions', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
