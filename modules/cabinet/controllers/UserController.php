<?php

namespace app\modules\cabinet\controllers;

use app\models\Subscriptions;
use app\models\Tariffs;
use app\models\User;
use app\models\search\UserSearch;
use app\models\UserProfile;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends DefaultController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProfile()
    {
        $checkProfile = null;
        $getCurrentRole =  array_keys(current_user_roles(current_user()))[0];
        if ($getCurrentRole == 'cadmin') {
            $checkProfile = check_tariff(current_user());
        } else {
              throw new \yii\web\HttpException(401, 'You do not have permission for this page!');
        }
        $tariffs = Tariffs::findAll(['active'=>Tariffs::ACTIVE]);
        $aditionalUserModel = new User();
        $companySubscription = Subscriptions::findOne(company_info()['subscription_id']);

        $dispatcher = extraUserPrices(trim('dispatcher'));
        $accountant = extraUserPrices(trim('accountant'));
        $safety_specialist = extraUserPrices(trim('safety_specialist'));
        $driver = extraUserPrices(trim('driver'));

        return $this->render('user_profile',[
            'checkProfile'=>$checkProfile,
            'tariffs'=>$tariffs,
            'aditionalUserModel'=>$aditionalUserModel,
            'companySubscription'=>$companySubscription,
            'dispatcher'=>$dispatcher,
            'accountant'=>$accountant,
            'safety_specialist'=>$safety_specialist,
            'driver'=>$driver,

        ]);
    }



    /**
     * Displays a single User model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'userProfile' =>  UserProfile::findOne(['user_id'=>$id])
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function checkMaximumUserAvaiblability($role)
    {
        /*writing here it*/
    }


    public function actionCreate()
    {
        $model = new User();
        $userProfile = new UserProfile();
        $model->scenario = User::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post()) && $userProfile->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->getDb()->beginTransaction();
            try {
               $amountOfUsersCurrently = countUserByRole(company_info()['user_id'],$model->role);
               $maximumAllowedUser = allTariffUsers(company_info()['subscription_id'],getCompanyTariff(),$model->role);
               if ($amountOfUsersCurrently > $maximumAllowedUser) {
                   Yii::$app->session->setFlash('danger',  Yii::t('user','The limit for selecter role has been reached, please buy more users for the selected type!'),true);
                    return $this->redirect(Yii::$app->request->referrer);

               } else {

                   if ($user = $model->signup($model->password_hash)) {
                       $role = Yii::$app->authManager->getRole($model->role);
                       Yii::$app->authManager->assign($role,$user->id);

                       $userProfile->company_id =company_name(false)->id;
                       $userProfile->user_id = $user->id;
                       if($userProfile->save()) {
                           $transaction->commit();
                       } else {
                           var_dump($userProfile->errors);
                       }
                       Yii::$app->session->setFlash('success', Yii::t('user','User has been created successfully!'));
                   }
                   return $this->redirect(['user/']);
               }

            }catch (DomainException $exception){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'userProfile' => $userProfile,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $userProfile =  UserProfile::findOne(['user_id'=>$id]);

        if ($model->load(Yii::$app->request->post()) && $userProfile->load(Yii::$app->request->post()) && $model->save() &&  $userProfile->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'userProfile' => $userProfile,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
