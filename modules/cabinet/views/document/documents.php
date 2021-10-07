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
    <?php foreach ($documentParent as $in=> $document): ?>
        <?php $docInfo =UserDocuments::percantageOfDocumentsByCategory($company_id,$document->id,$user_id)?>
        <h3 style="color: <?=$docInfo['full_done']=='full'?'#229954':'#C70039'?>">
            <?= $document->required_document_name ?>
            <span style="font-size: 15px"> <?=$docInfo['uploaded'].' / '.$docInfo['all']?></span>
            <span type="button" class="btn btn-success rounded-circle" data-toggle="collapse" data-target=".demo<?= $in ?>">
                <i class="fas fa-arrow-down"></i>
            </span>
        </h3>

        <?php foreach ($document->documentChildren as $index => $child): ?>
            <?php
            $id = $child->id;
            $checkifExist = UserDocuments::checkIfFileAlreadyExist($user_id, $id);
            $params = [
                'id' => $id,
                'in' => $in,
                'child' => $child,
                'document' => $document,
                'user_id' => $user_id,
                'model' => $model,
                'form' => $form,
                'checkifExist' => $checkifExist,
            ];
            ?>
            <?php if ($child->document_type == UserDocuments::TYPE_FILE): ?>
                <?= Yii::$app->controller->renderPartial('_type_file', $params) ?>
            <?php elseif ($child->document_type == UserDocuments::TYPE_TEXTINPUT): ?>
                <?= Yii::$app->controller->renderPartial('_type_text', $params) ?>
            <?php elseif ($child->document_type == UserDocuments::TYPE_DATE): ?>
                <?= Yii::$app->controller->renderPartial('_type_date', $params) ?>

            <?php endif ?>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tariff', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>
</div>

<?php endif; ?>

