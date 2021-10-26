<?php

use kartik\date\DatePicker;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Loads */
/* @var $form yii\widgets\ActiveForm */
$brokers = \yii\helpers\ArrayHelper::map(\app\models\Brokers::find()->all(),'id','broker_name');
$brokers2 = \yii\helpers\ArrayHelper::getColumn(\app\models\Brokers::find()->all(),'id','broker_name');
?>


<div class="loads-form" style="background: white">

    <?php $form = ActiveForm::begin(); ?>


    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Load information</h3>
                        </div>
                        <div class="card-body">
                            <!-- Date dd/mm/yyyy -->
                            <?= $form->field($model, 'load_id')->textInput() ?>
                            <?= $form->field($model, 'po_number')->textInput() ?>
                            <?= $form->field($model, 'commodity')->textInput() ?>
                            <?= $form->field($model, 'loaded_mile')->textInput() ?>
                            <?= $form->field($model, 'total_rate')->textInput() ?>



                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Load pick up information</h3>
                        </div>
                        <div class="card-body">

                            <?php
                            echo $form->field($model, 'schedule')->label(false)->widget(MultipleInput::className(), [
                                'id' => 'examplemodel-schedule',
                                'theme'=>'bs ',
                                'max' => 4,
                                'min'=>1,
                                'sortable' => true,
                                'allowEmptyList' => true,
                                'showGeneralError' => true,
                                'addButtonOptions' => [
                                    'class' => 'btn btn-success fa fa-plus',
                                ],
                                'removeButtonOptions' => [
                                    'class' => 'btn btn-danger fa fa-trash',

                                ],
                                'cloneButtonOptions'=> [
                                        'class'=> 'btn btn-success fa fa-plus'
                                ],
                                'rowOptions' => function($model) {
                                    $options = [];

                                    if ($model['priority'] > 1) {
                                        $options['class'] = 'danger';
                                    }
                                    return $options;
                                },
                                'cloneButton' => true,

                                'columns' => [
                                    [
                                        'name'  => 'user_id',
                                        'type'  => MultipleInputColumn::TYPE_DROPDOWN,
                                        'enableError' => true,
                                        'title' => 'Company',
                                        'defaultValue' => 33,

                                        'items' =>  [
                                            $brokers
                                        ]
                                    ],
                                    [
                                        'name'  => 'Date',
                                        'type'  => DatePicker::className(),
                                        'title' => 'Day',
                                        'value' => function($data) {
                                            return $data['day'];
                                        },
                                        'items' => [
                                            '0' => 'Saturday',
                                            '1' => 'Monday'
                                        ],
                                        'options' => [
                                                'bsVersion'=>4,
                                            'pluginOptions' => [
                                                'format' => 'dd.mm.yyyy',
                                                'todayHighlight' => true,

                                            ]
                                        ],
                                        'headerOptions' => [
                                            'style' => 'width: 250px;',
                                            'class' => 'day-css-class'
                                        ],
                                    ],

                                ]
                            ]);

                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col (left) -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Broker information</h3>
                        </div>
                        <div class="card-body">
                            <!-- Date -->
                            <?= $form->field($model, 'broker_id')->dropDownList($brokers) ?>
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Broker name:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Broker phone:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Broker email:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Broker address:</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card -->

                    <!-- iCheck -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Load drop off information</h3>
                        </div>
                        <div class="card-body">

                            <?php
                            echo $form->field($model, 'schedule')->label(false)->widget(MultipleInput::className(), [
                                'id' => 'examplemodel-schedule2',
                                'theme'=>'bs ',
                                'max' => 4,
                                'min'=>1,
                                'sortable' => true,
                                'allowEmptyList' => true,
                                'showGeneralError' => true,
                                'addButtonOptions' => [
                                    'class' => 'btn btn-success fa fa-plus',
                                ],
                                'removeButtonOptions' => [
                                    'class' => 'btn btn-danger fa fa-trash',

                                ],
                                'cloneButtonOptions'=> [
                                    'class'=> 'btn btn-success fa fa-plus'
                                ],
                                'rowOptions' => function($model) {
                                    $options = [];

                                    if ($model['priority'] > 1) {
                                        $options['class'] = 'danger';
                                    }
                                    return $options;
                                },
                                'cloneButton' => true,

                                'columns' => [
                                    [
                                        'name'  => 'user_id',
                                        'type'  => MultipleInputColumn::TYPE_DROPDOWN,
                                        'enableError' => true,
                                        'title' => 'Company',
                                        'defaultValue' => 33,

                                        'items' =>  [
                                            $brokers2
                                        ]
                                    ],
                                    [
                                        'name'  => 'Date',
                                        'type'  => DatePicker::className(),
                                        'title' => 'Day',
                                        'value' => function($data) {
                                            return $data['day'];
                                        },
                                        'items' => [
                                            '0' => 'Saturday',
                                            '1' => 'Monday'
                                        ],
                                        'options' => [
                                            'bsVersion'=>4,
                                            'pluginOptions' => [
                                                'format' => 'dd.mm.yyyy',
                                                'todayHighlight' => true,

                                            ]
                                        ],
                                        'headerOptions' => [
                                            'style' => 'width: 250px;',
                                            'class' => 'day-css-class'
                                        ],
                                    ],

                                ]
                            ]);

                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (right) -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>



    </div>





    <div class="form-group">
        <?= Html::submitButton(Yii::t('loads', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
