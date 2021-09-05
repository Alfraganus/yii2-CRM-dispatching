<?php
namespace app\models;

use Yii;
use yii\base\Model;
use mdm\admin\models\form\Login as Login;
/**
* LoginForm is the model behind the login form.
*
* @property-read User|null $user This property is read-only.
*
*/
class LoginForm extends Login
{

    public function setAuth($username)
    {
        $auth = Yii::$app->security->generateRandomString();
        $session = Yii::$app->session;
        $session->open();
        $session->set('auth', $auth);
        $session->close();
        $getUserModel = User::findOne(['username'=>$username]);
        $this->updateAuth($auth,$getUserModel->id);
    }

    public function updateAuth($auth,$user_id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
        UPDATE auth_assignment
        SET token = '$auth'
        WHERE user_id = '$user_id'");
       $command->queryOne();
    }

}