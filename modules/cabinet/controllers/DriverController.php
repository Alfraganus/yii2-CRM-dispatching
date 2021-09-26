<?php

namespace app\modules\cabinet\controllers;

use app\models\CompanyProfile;
use app\models\Drivers;
use app\models\search\DriversSearch;
use app\models\User;
use Carbon\Carbon;
use DomainException;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DriverController implements the CRUD actions for Drivers model.
 */
class DriverController extends Controller
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
     * Lists all Drivers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DriversSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Drivers model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Drivers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Drivers();
        $userModel = new User();
        $userModel->scenario = User::SCENARIO_CREATE;
        if ($model->load(Yii::$app->request->post()) && $userModel->load(Yii::$app->request->post())) {
            try {
                if ($user = $userModel->signup($userModel->password_hash)) {
                    $role = Yii::$app->authManager->getRole('driver');
                    Yii::$app->authManager->assign($role,$user->id);
                    $model->company_id = company_name(false)->id;
                    $model->user_id =$user->id;
                    $model->save();
                } else {
                    print_r($userModel->errors);
                }

                return $this->redirect(['index']);
            } catch (DomainException $exception) {
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'userModel'=>$userModel
        ]);
    }

    /**
     * Updates an existing Drivers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Drivers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Drivers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Drivers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Drivers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('driver', 'The requested page does not exist.'));
    }
}
