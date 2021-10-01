<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('documents', 'User Documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-documents-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('documents', 'Create User Documents'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'document_category_id',
            'user_role',
            'required_document_name',
            'company_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
