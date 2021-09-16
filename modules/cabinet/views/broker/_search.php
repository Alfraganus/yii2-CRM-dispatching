<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\BrokersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brokers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'broker_name') ?>

    <?= $form->field($model, 'broker_state') ?>

    <?= $form->field($model, 'broker_city') ?>

    <?= $form->field($model, 'broker_zip') ?>

    <?php // echo $form->field($model, 'broker_phone') ?>

    <?php // echo $form->field($model, 'broker_fax') ?>

    <?php // echo $form->field($model, 'broker_email') ?>

    <?php // echo $form->field($model, 'broker_contact_person') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('broker', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('broker', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
