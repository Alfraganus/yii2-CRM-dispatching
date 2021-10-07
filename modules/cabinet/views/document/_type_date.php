<?php

use app\models\UserDocuments;
use kartik\date\DatePicker;

?>
<div class="collapse demo<?=$in?> row">
    <label for="staticEmail" class="col-sm-1 col-form-label"><?=$child->document_name?>
        <?php if($checkifExist):?>
            <img src="/web/images/done2.png" style="width: 22px !important;float:right;margin-left: 15px" alt="">
        <?php endif;?>
    </label>
    <div class="col-sm-6">
        <?php if(!$checkifExist): ?>
            <?= $form->field($model, "file[$id]")->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ])->label(false) ?>
            <?= $form->field($model, "document_category_id[$id]")->hiddenInput(['value'=>$document['document_category_id']])->label(false)?>
            <?= $form->field($model, "document_id[$id]")->hiddenInput(['value'=>$document['id']])->label(false)?>

        <?php endif;?>
    </div>
</div>