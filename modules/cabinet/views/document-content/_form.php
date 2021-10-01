<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentsContent */
/* @var $form yii\widgets\ActiveForm */
$documents = \yii\helpers\ArrayHelper::map(\app\models\UserDocuments::find()->all(),'id','required_document_name');
?>

<div class="documents-content-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'document_name')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'document_id')->dropDownList($documents) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'document_type')->dropDownList(\app\models\UserDocuments::documentTypes()) ?>
        </div>

    </div>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('documents', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
