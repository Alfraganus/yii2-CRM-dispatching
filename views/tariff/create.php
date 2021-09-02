<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tariffs */

$this->title = Yii::t('tariff', 'Create Tariffs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tariff', 'Tariffs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariffs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
