<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subscriptions */

$this->title = Yii::t('subscriptions', 'Create Subscriptions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('subscriptions', 'Subscriptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscriptions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
