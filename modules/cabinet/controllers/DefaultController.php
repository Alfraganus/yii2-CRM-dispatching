<?php

namespace app\modules\cabinet\controllers;

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
    public function actionIndex()
    {
        $this->layout='cabinet';
        return $this->render('index');
    }
}
