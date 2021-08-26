<?php

namespace app\controllers;

use app\models\CompanyProfile;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class AuthController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionRegister()
    {
        $this->layout='auth';
        $models = [
           'userModel'=>new User(),
           'userProfile'=> new CompanyProfile()
        ];
        $userModel = new User();
        $userProfile = new CompanyProfile();
          if ($userModel->load(Yii::$app->request->post()) && $userProfile->load(Yii::$app->request->post()))
           {
              $transaction = Yii::$app->getDb()->beginTransaction();
            try {
                $userModel->password_hash = Yii::$app->security->generatePasswordHash($userModel->password);
                $userModel->save();

                $userProfile->user_id = $userModel->id;
                $userProfile->save();

                $authManager = Yii::$app->authManager;
                $role = $authManager->getRole('cadmin');
                $authManager->assign($role,$userProfile->user_id);

                $transaction->commit();
                return $this->redirect(['/']);
            }catch (DomainException $exception){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }
        return $this->render('register', [
            'userModel' => new User(),
            'userProfile' =>new CompanyProfile(),
        ]);
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
