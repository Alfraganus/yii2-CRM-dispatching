<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserDocuments */

$this->title = Yii::t('documents', 'Update User Documents: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('documents', 'User Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('documents', 'Update');
?>
<div class="user-documents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
