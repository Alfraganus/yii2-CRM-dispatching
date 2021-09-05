<?php use yii\widgets\ActiveForm;

$dispatcher = extraUserPrices(trim('dispatcher'));
$accountant = extraUserPrices(trim('accountant'));
$safety_specialist = extraUserPrices(trim('safety_specialist'));
$driver = extraUserPrices(trim('driver'));

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

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="/web/dist/img/user4-128x128.jpg"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">Nina Mcintire</h3>

                        <p class="text-muted text-center">Software Engineer</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
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
                                        <tr>
                                            <td>
                                                #
                                            </td>
                                            <td>
                                                <a>
                                                    AdminLTE v3
                                                </a>
                                                <br/>
                                                <small>
                                                    Created 01.01.2019
                                                </small>
                                            </td>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                       <center><img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar.png"><br> 1 accountant</center>
                                                    </li>
                                                    <li class="list-inline-item">
                                                         <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar2.png"><br> 1 accountant
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar3.png"><br> 1 accountant
                                                    </li>
                                                    <li class="list-inline-item">
                                                       <img alt="Avatar" class="table-avatar" src="/web/dist/img/avatar4.png"><br> 1 accountant
                                                    </li>
                                                </ul>
                                            </td>

                                            <td class="project-state">
                                                <span class="badge badge-success">Success</span>
                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>
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
                                                                <h3>Additional users to tariff</h3>
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
</section>


