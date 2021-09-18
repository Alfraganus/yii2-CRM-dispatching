<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Drivers */

$this->title = Yii::t('driver', 'Create Drivers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('driver', 'Drivers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drivers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel'=>$userModel
    ]) ?>

</div>
