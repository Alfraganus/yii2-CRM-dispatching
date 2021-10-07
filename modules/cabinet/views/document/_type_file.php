<?php

use app\models\UserDocuments;
use kartik\file\FileInput;

?>
<div class="collapse demo<?=$in?> row">
    <label for="staticEmail" class="col-sm-1 col-form-label">
        <?=$child->document_name?>
        <?php if($checkifExist):?>
            <img src="/web/images/done2.png" style="width: 25px !important;margin-left: 15px" alt="">
        <?php endif;?>
    </label>
    <div class="col-sm-6">
        <?php if(!$checkifExist): ?>

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
            <?= $form->field($model, "document_type[$id]")->hiddenInput(['value'=>$child->document_type])->label(false)?>
            <?= $form->field($model, "document_category_id[$id]")->hiddenInput(['value'=>$document['document_category_id']])->label(false)?>
            <?= $form->field($model, "document_id[$id]")->hiddenInput(['value'=>$document['id']])->label(false)?>
        <?php endif;?>
    </div>
</div>