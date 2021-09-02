<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdditionalUsersTable */

$this->title = Yii::t('user', 'Create Additional Users Table');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Additional Users Tables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-users-table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
