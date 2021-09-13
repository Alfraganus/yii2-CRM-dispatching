<?php

use yii\widgets\ActiveForm;

$session = Yii::$app->session;
$session->open();
$this->registerCssFile("/web/css/invoice.css");
$subtotal = 0;
?>

<div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #<?=$invoice?>
            </small>
        </h1>

        <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>

            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">


                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle"><?=company_name()?></span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                <?=company_info()['address']?>
                            </div>
                            <div class="my-1">
                                <?=company_info()['owner_contact_info']?>
                            </div>
                            <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600"> <?=company_info()['phone']?></b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #<?=$currentSubscription->id?></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue date: </span><span class="badge badge-success badge-pill px-25"><?=$currentSubscription->subscription_start_date?></span></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">finishing data: </span> <span class="badge badge-warning badge-pill px-25"><?=$currentSubscription->subscription_end_date?></span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Items</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                        <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                    </div>

                    <div class="text-95 text-secondary-d3">


                        <?php if ($additionalUsers['dispatcher'] > 0): ?>
                        <div class="text-95 text-secondary-d3">
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">#</div>
                                <div class="col-9 col-sm-5">Additional dispatcher</div>
                                <div class="d-none d-sm-block col-2"><?= $additionalUsers['dispatcher'] ?></div>
                                <div class="d-none d-sm-block col-2 text-95">
                                    $<?= $dprice = $additionalUsers['dispatcher']*extraUserPrices(trim('dispatcher'),false); $subtotal+=$dprice?></div>
                            </div>
                            <?php endif; ?>

                            <?php if ($additionalUsers['accountant'] > 0): ?>
                            <div class="text-95 text-secondary-d3">
                                <div class="row mb-2 mb-sm-0 py-25">
                                    <div class="d-none d-sm-block col-1">#</div>
                                    <div class="col-9 col-sm-5">Additional accountant</div>
                                    <div class="d-none d-sm-block col-2"><?= $additionalUsers['accountant'] ?></div>
                                    <div class="d-none d-sm-block col-2 text-95">
                                        $<?= $aprice = extraUserPrices(trim('accountant'),false) * $additionalUsers['accountant'];$subtotal+=$aprice ?></div>
                                </div>
                                <?php endif; ?>

                                <?php if ($additionalUsers['safety_specialist'] > 0): ?>
                                <div class="text-95 text-secondary-d3">
                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1">#</div>
                                        <div class="col-9 col-sm-5">Additional safety specialist</div>
                                        <div class="d-none d-sm-block col-2"><?= $additionalUsers['safety_specialist'] ?></div>
                                        <div class="d-none d-sm-block col-2 text-95">
                                            $<?=$sprice = extraUserPrices(trim('safety_specialist'),false)* $additionalUsers['safety_specialist'];$subtotal+=$sprice?></div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($additionalUsers['driver'] > 0): ?>
                                    <div class="text-95 text-secondary-d3">
                                        <div class="row mb-2 mb-sm-0 py-25">
                                            <div class="d-none d-sm-block col-1">#</div>
                                            <div class="col-9 col-sm-5">Additional driver</div>
                                            <div class="d-none d-sm-block col-2"><?= $additionalUsers['driver'] ?></div>
                                            <div class="d-none d-sm-block col-2 text-95">
                                                $<?=$ddprice = extraUserPrices(trim('driver'),false)*$additionalUsers['driver'];$subtotal+=$ddprice ?></div>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="row border-b-2 brc-default-l2"></div>

                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0"></div>


                                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    SubTotal
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-120 text-secondary-d1">$<?=number_format($subtotal,2)?></span>
                                                </div>
                                            </div>

                                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                                <div class="col-7 text-right">
                                                    Total Amount
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-150 text-success-d3 opacity-2">$<?=$overall = number_format($subtotal-$discounted??0,2)?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />

                                    <div>
                                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                                        <?php $form = ActiveForm::begin(['action' =>['tariff/pay-additional-user']]); ?>
                                        <button type="submit" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</button>
                                        <?php ActiveForm::end(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $session->set('selectedAditionalUsers',$additionalUsers);?>


