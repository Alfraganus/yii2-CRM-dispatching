<?php

use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserDocuments;
$user_id = Yii::$app->request->get('user_id');
?>
<?php if(sizeOf($userUnsubmittedDocuments) < 1): ?>
    <div class="alert alert-success">
        <strong>No document to upload or all documents have been submitted!</strong>
    </div>
<?php else: ?>

<div style="display:<?=($isSafety ==0)?'none':''?>;">
<div class="alert alert-success">
    <strong> <h2 class="text-center">The List of drivers documents!</h2></strong>
</div>
<?php $form = ActiveForm::begin(); ?>
    <?php foreach ($documentParent as $document): ?>
    <h3><?=$document->required_document_name?></h3>
<?php   foreach ($document->documentChildren as $index => $child): ?>
            <?= $form->field($model, "document_type[$id]")->hiddenInput(['value'=>$child->document_type])->label(false)?>

            <?php $id = $child->id; ?>
            <?php if ($child->document_type == UserDocuments::TYPE_FILE): ?>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-4 col-form-label"><?=$child->document_name?> </label>
        <div class="col-sm-6">
            <?php if(!UserDocuments::checkIfFileAlreadyExist($user_id,$id)): ?>

          <?= $form->field($model, "file[$id]")->widget(FileInput::classname(), [
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
                  'browseLabel' =>  'Attachment'
              ]
          ])->label(false);?>
          <?= $form->field($model, "document_category_id[$id]")->hiddenInput(['value'=>$document['document_category_id']])->label(false)?>
          <?= $form->field($model, "document_id[$id]")->hiddenInput(['value'=>$document['id']])->label(false)?>
            <?php else : ?>
                <img src="/web/images/done.png" style="width: 60px;" alt="">
            <?php endif;?>
        </div>
    </div>
            <?php elseif ($child->document_type == UserDocuments::TYPE_TEXTINPUT): ?>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label"><?=$child->document_name?> </label>
                <div class="col-sm-6">
                    <?php if(!UserDocuments::checkIfFileAlreadyExist($user_id,$id)): ?>
                    <?= $form->field($model, "file[$id]")->textInput()->label(false)?>
                    <?= $form->field($model, "document_category_id[$id]")->hiddenInput(['value'=>$document['document_category_id']])->label(false)?>
                    <?= $form->field($model, "document_id[$id]")->hiddenInput(['value'=>$document['id']])->label(false)?>
                    <?php else : ?>
                        <img src="/web/images/done.png" style="width: 60px;" alt="">
                    <?php endif;?>
                </div>
            </div>
            <?php elseif ($child->document_type == UserDocuments::TYPE_DATE): ?>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label"><?=$child->document_name?> </label>
                    <div class="col-sm-6">
                        <?php if(!UserDocuments::checkIfFileAlreadyExist($user_id,$id)): ?>
                        <?= $form->field($model, "file[$id]")->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Enter birth date ...'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd/mm/yyyy'
                            ]
                        ])->label(false) ?>
                        <?= $form->field($model, "document_category_id[$id]")->hiddenInput(['value'=>$document['document_category_id']])->label(false)?>
                        <?= $form->field($model, "document_id[$id]")->hiddenInput(['value'=>$document['id']])->label(false)?>
                        <?php else : ?>
                            <img src="/web/images/done.png" style="width: 60px;" alt="">
                        <?php endif;?>
                    </div>
                </div>

        <?php endif?>
<?php endforeach; ?>
    <?php endforeach; ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('tariff', 'Save'), ['class' => 'btn btn-success']) ?>
</div>


<?php ActiveForm::end(); ?>
</div>

<?php endif; ?>

