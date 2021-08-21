<?php

use common\models\Profile;
use yii\helpers\Url;

$user = current_user(); ?>


<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color: #fff;">
                <a href="<?= admin_url(); ?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="#" alt="logo" height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="#" alt="logo" height="40">
                    </span>
                </a>

                <a href="<?= admin_url(); ?>" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="#" alt="logo" height="45">
                    </span>
                    <span class="logo-lg">
                        <img src="#" alt="logo" height="45">
                    </span>
                </a>
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="<?= _e('Search'); ?>...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-inline-block">
                <a href=#" class="btn header-item header-item-icon waves-effect" target="_blank">
                    <i class="ri-store-3-fill" data-toggle="tooltip" data-placement="bottom" title="<?= _e('Go to site'); ?>"></i>
                </a>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="#" alt="#">
                    <span class="d-none d-xl-inline-block ml-1">test</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="<?= Url::to(['/profile']); ?>">
                        <i class="ri-user-line align-middle mr-1"></i> <?= _e('Profile'); ?>
                    </a>
                    <a class="dropdown-item d-block" href="<?= Url::to(['/profile/settings']); ?>">
                        <i class="ri-settings-2-line align-middle mr-1"></i> <?= _e('Edit profile'); ?>
                    </a>
                    <a class="dropdown-item d-block" href="<?= Url::to(['/profile/password']); ?>">
                        <i class="ri-key-2-line align-middle mr-1"></i> <?= _e('Password'); ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?= Url::to(['/auth/logout']); ?>">
                        <i class="ri-shut-down-line align-middle mr-1 text-danger"></i> <?= _e('Log out'); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>