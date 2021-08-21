<?php
$app = Yii::$app;

use yii\helpers\Url; ?>

<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?= Url::to(['/']); ?>" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span><?= _e('Dashboard'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-line-chart-line"></i>
                        <span> <?= _e('Sales'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Url::to(['/orders']); ?>"> <?= _e('All orders'); ?></a></li>
                        <li><a href="<?= Url::to(['/orders/new']); ?>"> <?= _e('New orders'); ?></a></li>
                        <li><a href="<?= Url::to(['/orders/processing']); ?>"> <?= _e('Processing orders'); ?></a></li>
                        <li><a href="<?= Url::to(['/orders/completed']); ?>"> <?= _e('Completed orders'); ?></a></li>
                        <li><a href="<?= Url::to(['/orders/cancelled']); ?>"> <?= _e('Cancelled orders'); ?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span> <?= _e('Products'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Url::to(['/products/action/create']); ?>"> <?= _e('Add new'); ?></a></li>
                        <li><a href="<?= Url::to(['/products/all']); ?>"> <?= _e('All products'); ?></a></li>
                        <li><a href="<?= Url::to(['/products/recommended']); ?>"> <?= _e('Recommended products'); ?></a></li>
                        <li><a href="<?= Url::to(['/products/sponsored']); ?>"> <?= _e('Sponsored products'); ?></a></li>
                        <li><a href="<?= Url::to(['/fields/brands']); ?>"> <?= _e('Trademarks'); ?></a></li>
                        <li><a href="<?= Url::to(['/fields/category']); ?>"> <?= _e('Categories'); ?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-checkbox-multiple-blank-line"></i>
                        <span> <?= _e('Content'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Url::to(['/content/posts']); ?>"> <?= _e('Posts'); ?></a></li>
                        <li><a href="<?= Url::to(['/content/pages']); ?>"> <?= _e('Pages'); ?></a></li>
                        <!-- <li><a href="<?= Url::to(['/content/tags']); ?>"> <?= _e('Tags'); ?></a></li>
                        <li><a href="<?= Url::to(['/content/categories']); ?>"> <?= _e('Categories'); ?></a></li> -->
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-brush-2-fill"></i>
                        <span> <?= _e('Appearance'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Url::to(['/appearance/menus']); ?>"> <?= _e('Menus'); ?></a></li>
                        <li><a href="<?= Url::to(['/appearance/themes']); ?>"> <?= _e('Themes'); ?></a></li>
                        <li><a href="<?= Url::to(['/appearance/widgets']); ?>"> <?= _e('Widgets'); ?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-folder-3-line"></i>
                        <span> <?= _e('Storage'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Url::to(['/storage/files']); ?>"> <?= _e('Files'); ?></a></li>
                        <li><a href="<?= Url::to(['/storage/images/?view=grid']); ?>"> <?= _e('Images'); ?></a></li>
                        <li><a href="<?= Url::to(['/storage/uploads']); ?>"> <?= _e('Uploads'); ?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-store-2-line"></i>
                        <span> <?= _e('Suppliers'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Url::to(['/suppliers/users']); ?>"> <?= _e('All users'); ?></a></li>
                        <li><a href="<?= Url::to(['/suppliers/company']); ?>"> <?= _e('All suppliers'); ?></a></li>
                        <li><a href="<?= Url::to(['/suppliers/company/pending']); ?>"> <?= _e('Pending suppliers'); ?></a></li>
                        <li><a href="<?= Url::to(['/suppliers/company/blocked']); ?>"> <?= _e('Blocked suppliers'); ?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-group-line"></i>
                        <span> <?= _e('Customers'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Url::to(['/customers/users']) ?>"> <?= _e('All customers'); ?></a></li>
                        <li><a href="<?= Url::to(['/customers/company']) ?>"> <?= _e('All companies'); ?></a></li>
                        <li><a href="<?= Url::to(['/customers/company/pending']); ?>"> <?= _e('Pending companies'); ?></a></li>
                        <li><a href="<?= Url::to(['/customers/company/blocked']); ?>"> <?= _e('Blocked companies'); ?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-3-line"></i>
                        <span> <?= _e('System'); ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= Url::to('/system/settings') ?>"> <?= _e('Settings'); ?></a></li>
                        <li><a href="<?= Url::to(['/system/languages']); ?>"> <?= _e('Languages'); ?></a></li>
                        <li><a href="<?= Url::to(['/system/translations']); ?>"> <?= _e('Translations'); ?></a></li>
                        <li><a href="<?= Url::to(['/system/payments']) ?>"> <?= _e('Currency'); ?></a></li>
                        <li><a href="<?= Url::to(['/system/roles']); ?>"> <?= _e("Roles & Permissions"); ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>