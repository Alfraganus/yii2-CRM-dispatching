<?php

namespace app\modules\cabinet\controllers;

use app\models\Subscriptions;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Yii;
use app\models\Tariffs;
use app\models\search\TariffsSearch;
use yii\bootstrap\NavBar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TariffController implements the CRUD actions for Tariffs model.
 */
class TariffController extends Controller
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

    public function actionInvoice()
    {
        if($post  = Yii::$app->request->post()) {
            $session = Yii::$app->session;
            $session->open();

            $selectedTariff = Tariffs::findOne($post['User']['tariff']);
            $invoice = time();
            $selectedAditionalUsers = array(
                'dispatcher'=>$post['User']['dispatcher'],
                'accountant'=>$post['User']['accountant'],
                'safety'=>$post['User']['safety'],
                'driver'=>$post['User']['driver'],
            );
            $tariffs = Tariffs::findOne(['active'=>Tariffs::ACTIVE]);
            $session->set('additionalUsers',$selectedAditionalUsers);
            $session->set('tariff_id',$tariffs->id);
            return $this->render('invoice',[
                'selectedTariff'=>$selectedTariff,
                'additionalUsers'=>$selectedAditionalUsers,
                'invoice'=>$invoice,
                'tariff'=>$tariffs,
            ]);
        }
        else {
            throw new \yii\web\HttpException(401, 'Request must be from POST!');
        }
    }

    public function actionPayTariff()
    {
        $session = Yii::$app->session;
        if($post  = Yii::$app->request->post()) {
            $users = $session->get('additionalUsers');

            if ($session->isActive) {
            $tariff = Tariffs::findOne($session->get('tariff_id'));
                $subscriptions = new Subscriptions();
                $subscriptions->tariff_id =  $session->get('tariff_id');
                $subscriptions->company_id = current_user_id();
                $subscriptions->subscription_start_date = Carbon::now();
                $subscriptions->subscription_end_date = Carbon::now()->addMonths($tariff->months_quantity);
                $subscriptions->overall_price = $session->get('overall_price');
                $subscriptions->save(false);
                return $this->redirect('/');
            }

        }
    }


    /**
     * Lists all Tariffs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TariffsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tariffs model.
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
     * Creates a new Tariffs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tariffs();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tariffs model.
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
     * Deletes an existing Tariffs model.
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
     * Finds the Tariffs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tariffs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tariffs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('tariff', 'The requested page does not exist.'));
    }
}
