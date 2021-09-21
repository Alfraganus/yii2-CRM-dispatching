<?php
$controller =  Yii::$app->controller->uniqueid;

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/web/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">IDispatch TMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                <a href="#" class="d-block">
                    <img src="/web/images/no_user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?=dispatcher_name()?>
            </div>
            </a>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="<?=\yii\helpers\Url::to(['broker/'])?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Brokers</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?=\yii\helpers\Url::to(['carrier/'])?>" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Carriers</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?=\yii\helpers\Url::to(['driver/'])?>" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Drivers</p>
                    </a>
                </li>
            </ul>
    </div>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
