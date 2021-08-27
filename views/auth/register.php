<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>
<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span> <img src="https://amar.vote/assets/img/amarVotebd.png" class="w-75" alt="Logo"> </span><br/>
            <span class="logo_title mt-5"> Registration Dashboard </span>

        </div>
        <div class="card-body">
            <form action="" method="post">

                    <?= $form->field($userModel, 'username')->textInput(['placeholder' =>'login',['class'=>'input-group-prepend']])->label(false) ?>

                <?= $form->field($userModel, 'password_hash')->textInput(['placeholder' =>'password',['class'=>'input-group-prepend']])->label(false) ?>
                <?= $form->field($userModel, 'email')->textInput(['placeholder' =>'Email'])->label(false) ?>
                <?= $form->field($userProfile, 'company_name')->textInput(['placeholder' =>'Company name'])->label(false) ?>
                <?= $form->field($userProfile, 'address')->textInput(['placeholder' =>'Address'])->label(false) ?>
                <?= $form->field($userProfile, 'phone')->textInput(['placeholder' =>'Phone'])->label(false) ?>
                <?= $form->field($userProfile, 'owner_contact_info')->textInput(['placeholder' =>'Company contact person'])->label(false) ?>


                <div class="form-group">
                    <input type="submit" name="btn" value="register" class="btn btn-outline-danger float-right login_btn">
                </div>

            </form>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<style>
    .help-block {
        color: aliceblue !important;
    }
</style>
