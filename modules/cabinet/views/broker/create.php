<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Brokers */

$this->title = Yii::t('broker', 'Create Brokers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('broker', 'Brokers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brokers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
