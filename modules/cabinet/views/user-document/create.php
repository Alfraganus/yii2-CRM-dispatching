<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserDocuments */

$this->title = Yii::t('documents', 'Create User Documents');
$this->params['breadcrumbs'][] = ['label' => Yii::t('documents', 'User Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-documents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
