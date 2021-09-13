<?php use yii\widgets\ActiveForm;


if(!is_null($checkProfile)) : ?>
<?php if($checkProfile['status'] == 'active') :
    $daysLeft = $checkProfile['leftDays'];
    ?>
    <div class="alert alert-warning" role="alert">
        <?=Yii::t('user',"You have $daysLeft day(s) left in your trial")?>
    </div>
<?php elseif($checkProfile['status'] == 'inactive') : ?>
    <div class="alert alert-danger" role="alert">
        <?=Yii::t('user',"Your trial has ended on: ").$checkProfile['finished_date']?>
    </div>
<?php endif; ?>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i><?= Yii::$app->session->getFlash('success') ?>!</h4>
    </div>
<?php endif; ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img "
                                 src="/web/images/company.png"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?=company_info()['company_name']?></h3>

                        <p class="text-muted text-center"><?=company_info()['address']?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Contact:</b> <a class="float-right"><?=company_info()['owner_contact_info']?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a class="float-right"><?=company_info()['phone']?></a>
                            </li>
                            <li class="list-group-item">
                                <b>email:</b> <a class="float-right"><?=Yii::$app->user->identity->email??''?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <?php if(!empty(company_info()['subscription_id'])): ?>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tariff info</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Tariff name</strong>

                        <p class="text-muted">
                           <?=$companySubscription->tariff->tariff_name??'data not found!'?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Current subscription start date</strong>

                        <p class="text-muted">  <?=date('d-m-Y H:i',strtotime($companySubscription->subscription_start_date))??'data not found!'?></p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i>  Current subscription finishing date</strong>

                        <p class="text-muted">  <?=date('d-m-Y H:i',strtotime($companySubscription->subscription_end_date))??'data not found!'?></p>


                    </div>
                    <!-- /.card-body -->
                </div>
                <?php endif; ?>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><?=Yii::t('user','Current tariff')?></a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Buy tariff</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="card-body p-0">
                                    <div class="card-body p-0">
                                        <table class="table table-striped projects">
                                            <thead>
                                            <tr>
                                                <th style="width: 30%">
                                                   Current tariff
                                                </th>
                                                <th style="width: 50%">
                                                    Staff included
                                                </th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a>
                                                            <?=$companySubscription->tariff->tariff_name??'data not found!'?>
                                                        </a>
                                                        <br/>
                                                        <small>
                                                            <?=\Carbon\Carbon::now()->diffInDays($companySubscription->subscription_end_date)?> days left
                                                        </small>
                                                    </td>
                                                    <td colspan="2">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <center>
                                                                            <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar.png"><br> <?= allTariffUsers($companySubscription->id,$companySubscription->tariff->id,'accountant')?> accountant
                                                                </center>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <center>
                                                                    <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar2.png"><br> <?= allTariffUsers($companySubscription->id,$companySubscription->tariff->id,'safety_specialist')?> safety specialist
                                                                </center>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <center>
                                                                    <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar3.png"><br>  <?= allTariffUsers($companySubscription->id,$companySubscription->tariff->id,'dispatcher')?> dispatcher
                                                                </center>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <center>
                                                                    <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar4.png"><br>  <?= allTariffUsers($companySubscription->id,$companySubscription->tariff->id,'driver')?>driver
                                                                </center>
                                                            </li>

                                                        </ul>
                                                    <td class="project-state">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-au">Buy additional users</button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->

                                    <div class="card-body p-0">
                                        <table class="table table-striped projects">
                                            <thead>
                                            <tr>
                                                <th style="width: 1%">
                                                    #
                                                </th>
                                                <th style="width: 30%">
                                                    Project Name
                                                </th>
                                                <th style="width: 50%">
                                                    Staff included
                                                </th>

                                                <th style="width: 30%" class="text-center">
                                                    Status
                                                </th>
                                                <th style="width: 20%">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($tariffs as $id => $tariff): $id++ ?>
                                            <?php $tarifUser = tariffUsers($tariff->id) ?>
                                            <tr>
                                                <td>
                                                 <?=$id?>
                                                </td>
                                                <td>
                                                    <a>
                                                       <?=$tariff->tariff_name?>
                                                    </a>
                                                    <br/>
                                                    <small>
                                                        <?=$tariff->description?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <center>
                                                                <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar.png"><br> <?=$tarifUser['accountant']?> accountant
                                                            </center>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <center>
                                                            <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar2.png"><br> <?=$tarifUser['safety_specialist']?> safety specialist
                                                            </center>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <center>
                                                            <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar3.png"><br> <?=$tarifUser['dispatcher']?> dispatcher
                                                            </center>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <center>
                                                            <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar4.png"><br> <?=$tarifUser['driver']?> driver
                                                            </center>
                                                        </li>
                                                    </ul>
                                                </td>

                                                <td class="project-state">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg<?=$id?>">Buy tariff</button>
                                                </td>

                                            </tr>
                                                <?php $form = ActiveForm::begin(['action' =>['tariff/invoice']]); ?>
                                                <!-- form modal  -->
                                                <div class="modal fade bd-example-modal-lg<?=$id?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content" style="padding: 30px">
                                                            <div class="container">
                                                                <h3>Additional users for <?=$tariff->tariff_name?></h3>
                                                                <?= $form->field($aditionalUserModel, 'tariff')->hiddenInput(['value' => $tariff->id])->label(false) ?>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <?= $form->field($aditionalUserModel, 'dispatcher')->textInput()->input('number',['value'=>0])->label("Dispatcher 1x $$dispatcher") ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <?= $form->field($aditionalUserModel, 'accountant')->textInput()->input('number',['value'=>0])->label("accountant 1x $$accountant") ?>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <?= $form->field($aditionalUserModel, 'safety')->textInput()->input('number',['value'=>0])->label("safety 1x $$safety_specialist") ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <?= $form->field($aditionalUserModel, 'driver')->textInput()->input('number',['value'=>0])->label("driver 1x $$dispatcher") ?>
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-success">Go to invoice</button>
                                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php ActiveForm::end(); ?>

                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>

                            </div>
                            <!-- /.tab-pane -->

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <?php $form = ActiveForm::begin(['action' =>['tariff/buy-additional-users']]); ?>
    <!-- form modal  -->
    <div class="modal fade bd-example-modal-lg-au" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding: 30px">
                <div class="container">
                    <h3>Additional users for <?=$tariff->tariff_name?></h3>
                    <?= $form->field($aditionalUserModel, 'tariff')->hiddenInput(['value' => $tariff->id])->label(false) ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($aditionalUserModel, 'dispatcher')->textInput()->input('number',['value'=>0])->label("Dispatcher 1x $".extraUserPrices('dispatcher',true)) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($aditionalUserModel, 'accountant')->textInput()->input('number',['value'=>0])->label("accountant 1x $".extraUserPrices('accountant',true)) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($aditionalUserModel, 'safety')->textInput()->input('number',['value'=>0])->label("safety 1x $".extraUserPrices('safety_specialist',true)) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($aditionalUserModel, 'driver')->textInput()->input('number',['value'=>0])->label("driver 1x $".extraUserPrices('driver',true)) ?>
                        </div>
                    </div>
                    <button class="btn btn-success">Go to invoice</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</section>


