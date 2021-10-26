<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Loads */

$this->title = Yii::t('loads', 'Create Loads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('loads', 'Loads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loads-create">

    <h1 class="content-header"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
