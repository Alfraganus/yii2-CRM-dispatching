<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cariers */

$this->title = Yii::t('carrier', 'Create Cariers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('carrier', 'Cariers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cariers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel'=>$userModel
    ]) ?>

</div>
