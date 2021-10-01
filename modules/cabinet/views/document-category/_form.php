<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_category')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('broker', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
