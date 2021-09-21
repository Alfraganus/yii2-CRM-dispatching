<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BrokersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('broker', 'Brokers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brokers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('broker', 'Create Brokers'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'broker_name',
            'broker_address',
            'broker_phone',
            'broker_fax',
            'broker_email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
