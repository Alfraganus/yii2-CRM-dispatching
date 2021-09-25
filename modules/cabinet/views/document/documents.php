<?php
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="alert alert-success">
    <strong> <h2 class="text-center">The List of drivers documents!</h2></strong>
</div>

<?php $form = ActiveForm::begin(); ?>
<?php foreach ($userUnsubmittedDocuments as $index => $documents): ?>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label"><?=$documents['required_document_name']?></label>
        <div class="col-sm-8">
          <?= $form->field($model, "file[$index]")->widget(FileInput::classname(), [
              'options' => [
                      'accept' => 'image/*',
                       'multiple' => false,
              ],
              'pluginOptions' => [
                  'showPreview' => false,
                  'showCaption' => true,
                  'showRemove' => false,
                  'showUpload' => false,
                  'showCancel' => false,
                  'mainClass' => 'input-group-lg',
                  'browseClass' => 'btn btn-primary btn-block',
                  'browseLabel' =>  'Select Photo'
              ]
          ])->label(false);?>
        </div>
    </div>

<?php endforeach; ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('tariff', 'Save'), ['class' => 'btn btn-success']) ?>
</div>


<?php ActiveForm::end(); ?>

