<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('documents', 'Documents Contents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-content-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('documents', 'Create Documents Content'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'document_id',
            'document_type',
            'company_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
