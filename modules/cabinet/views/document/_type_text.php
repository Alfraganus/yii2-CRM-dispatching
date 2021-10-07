<?php

use app\models\UserDocuments;

?>
<div class="collapse demo<?= $in ?> row">
    <label for="staticEmail" class="col-sm-1 col-form-label">
       <?= $child->document_name ?>
        <?php if($checkifExist):?>
            <img src="/web/images/done2.png" style="width: 25px !important;margin-left: 15px" alt="">
        <?php endif;?>
    </label>
    <div class="col-sm-6">
        <?php if (!$checkifExist): ?>
            <?= $form->field($model, "file[$id]")->textInput()->label(false) ?>
            <?= $form->field($model, "document_category_id[$id]")->hiddenInput(['value' => $document['document_category_id']])->label(false) ?>
            <?= $form->field($model, "document_id[$id]")->hiddenInput(['value' => $document['id']])->label(false) ?>

        <?php endif; ?>
    </div>
</div>