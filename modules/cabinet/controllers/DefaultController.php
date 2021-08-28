<?php

namespace app\modules\cabinet\controllers;

use app\models\LoginForm;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `panel` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout ='cabinet';

    public function actionIndex()
    {
        $this->layout='cabinet';
        return $this->render('index');
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['/auth/login']);
    }

}
