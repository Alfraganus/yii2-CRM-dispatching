<?php

namespace app\modules\cabinet;

use Yii;
use yii\helpers\Url;

/**
 * panel module definition class
 */
class cabinet extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\cabinet\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if (Yii::$app->user->isGuest) {
        return Yii::$app->response->redirect(array('auth/login'));
        }
        $this->layout = 'cabinet';
//        $currentAuth = Yii::$app->session->get('auth');
//        var_dump(Yii::$app->session->get('auth'));
        // custom initialization code goes here
    }
}
