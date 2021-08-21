<?php
// Get theme bundle
function theme_bundle()
{
    $store_theme = get_setting_value('store_theme');

    if ($store_theme) {
        $theme_path = THEMES_PATH . $store_theme . DS;
        $theme_alias = '@themes/' . $store_theme . '/';

        $app_assets = $theme_alias;
        $app_assets = substr($app_assets, 1);
        $app_assets = str_replace('/', '\\', $app_assets);
        $app_assets = $app_assets . 'app\AppAsset';

        if (is_dir($theme_path)) {
            return Yii::$app->getAssetManager()->getBundle($app_assets);
        }
    }
}

// Get theme assets
function theme_assets($url)
{
    $bundle = theme_bundle();

    if ($bundle) {
        $baseUrl = substr($bundle->baseUrl, 1);
        $baseUrl = store_url($baseUrl);

        return $baseUrl . '/' . trim($url, '/');
    }
}

// Get theme partial
function theme_partial($name = '', $data = array(), $view_as_string = false)
{
    $file_name = trim($name, '/');
    $file_name = str_replace('.php', '', $file_name);
    $partials_path = \Yii::$app->controller->theme_path . 'partials/';
    $partials_alias = \Yii::$app->controller->theme_alias . 'partials/';
    $file = "{$partials_path}{$file_name}.php";

    if (is_file($file)) {
        $file = "{$partials_alias}{$file_name}.php";
        $render_file = \Yii::$app->view->renderFile($file, $data);

        if ($view_as_string) {
            return $render_file;
        } else {
            echo $render_file;
        }
    }
}

// Theme logo image
function theme_logo_image()
{
    $bundle = theme_bundle();
    $image = images_url('default-logo.png');

    if ($bundle) {
        $default_items = isset($bundle->default_items) ? $bundle->default_items : array();
        $default_image = array_value($default_items, 'logo');

        if ($default_image) {
            $image = theme_assets($default_image);
        }
    }

    return get_setting_value('store_logo', $image);
}

// Theme logo image
function theme_favicon_image()
{
    $bundle = theme_bundle();
    $image = images_url('default-favicon.ico');

    if ($bundle) {
        $default_items = isset($bundle->default_items) ? $bundle->default_items : array();
        $default_image = array_value($default_items, 'favicon');

        if ($default_image) {
            $image = theme_assets($default_image);
        }
    }

    return get_setting_value('store_favicon', $image);
}
