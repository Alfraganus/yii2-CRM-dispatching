<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CabinetAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://pro.fontawesome.com/releases/v5.10.0/css/all.css',
        'web/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'web/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'web/plugins/jqvmap/jqvmap.min.css',
        'web/dist/css/adminlte.min.css',
        'web/css/site.css',
        'web/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'web/plugins/daterangepicker/daterangepicker.css',
        'web/plugins/summernote/summernote-bs4.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'

    ];

    public $js = [
        'web/js/main.js',
        'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
        'web/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'web/plugins/chart.js/Chart.min.js',
        'web/plugins/sparklines/sparkline.js',
        'web/plugins/jqvmap/jquery.vmap.min.js',
        'web/plugins/jqvmap/maps/jquery.vmap.usa.js',
        'web/plugins/jquery-knob/jquery.knob.min.js',
        'web/plugins/moment/moment.min.js',
        'web/plugins/daterangepicker/daterangepicker.js',
        'web/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'web/plugins/summernote/summernote-bs4.min.js',
        'web/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'web/dist/js/adminlte.js',
        'web/dist/js/pages/dashboard.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];


}
