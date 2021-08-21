<?php

namespace base;

use backend\models\Language;
use seller\models\Shop;
use Yii;
use yii\web\Controller;

/**
 * Seller controller
 */
class SellerController extends Controller
{
    public $shop;
    public $shop_id;
    private $login_url = '/account/login';

    /**
     * Init
     *
     * @return void
     */
    public function init()
    {
        parent::init();

        // Init container
        $container = new Container();
        $container::$prefix = 'sr';
        $container::$context = 'seller';

        // Init language
        $language = new Language();
        $language->defaultLang = 'en';
        $language->defaultLocale = 'en_US';

        $language->getLanguagesList(['status' => 1]);
        $language->getCurrentLanguage();
        $language->getContentLanguage();
        $language->checkAndSet();
    }

    /**
     * Before action
     *
     * @return string
     */
    public function beforeAction($action)
    {
        $app = Yii::$app;
        $redirect_to_login = true;

        $this->layout = 'dashboard';

        if (!$app->user->isGuest) {
            $seller_url = seller_url();
            $roles = current_user_roles();

            if ($roles && isset($roles['seller'])) {
                $redirect_to_login = false;
                $this->shop = Shop::getMyShop();

                if ($this->shop) {
                    $this->shop_id = $this->shop->id;

                    Container::push('my_shop', $this->shop);
                    Container::push('my_shop_id', $this->shop_id);

                    if ($this->shop->deleted) {
                        $this->redirect($seller_url . 'st/deleted')->send();
                    } elseif ($this->shop->status == '-1') {
                        $this->redirect($seller_url . 'st/blocked')->send();
                    } elseif ($this->shop->status != 1) {
                        $this->redirect($seller_url . 'st/review')->send();
                    }
                } else {
                    $this->redirect($seller_url . 'st/notfound')->send();
                }
            } else {
                return $this->redirect($seller_url)->send();
            }
        }

        if ($redirect_to_login) {
            $current_url = trim($app->request->url, '/');

            if (!empty($current_url)) {
                $app->user->loginUrl = [$this->login_url, 'redirect' => $current_url];
            } else {
                $app->user->loginUrl = [$this->login_url];
            }

            return $this->redirect($app->user->loginUrl)->send();
        } else {
            return parent::beforeAction($action);
        }
    }

    /**
     * Register JS file or files
     *
     * @param [type] $file
     * @return void
     */
    public function registerJs($file)
    {
        if ($file) {
            $ver = APP_VERSION;
            $bundle = \seller\assets\DashboardAsset::register(\Yii::$app->view);

            if (is_array($file)) {
                foreach ($file as $fi) {
                    if (strpos($fi, '.js?') !== false) {
                        $bundle->js[] = $fi;
                    } else {
                        $bundle->js[] = $fi . "?ver={$ver}";
                    }
                }
            } else {
                if (strpos($file, '.js?') !== false) {
                    $bundle->js[] = $file . "?ver={$ver}";
                } else {
                    $bundle->js[] = $file . "?ver={$ver}";
                }
            }
        }
    }

    /**
     * Register CSS file or files
     *
     * @param [type] $file
     * @return void
     */
    public function registerCss($file)
    {
        if ($file) {
            $ver = APP_VERSION;
            $bundle = \seller\assets\DashboardAsset::register(\Yii::$app->view);

            if (is_array($file)) {
                foreach ($file as $fi) {
                    if (strpos($fi, '.css?') !== false) {
                        $bundle->css[] = $fi;
                    } else {
                        $bundle->css[] = $fi . "?ver={$ver}";
                    }
                }
            } else {
                if (strpos($file, '.css?') !== false) {
                    $bundle->css[] = $file . "?ver={$ver}";
                } else {
                    $bundle->css[] = $file . "?ver={$ver}";
                }
            }
        }
    }
}
