<?php

namespace app\modules\cabinet\controllers;

use app\models\AdditionalUsersTable;
use app\models\CompanyProfile;
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
            $selectedTariff = Tariffs::findOne(['id'=>$post['User']['tariff']]);
            $selectedTariffMonth = $selectedTariff->months_quantity;

            $currentSubInfo = Subscriptions::findOne([
                'id'=>company_info()['subscription_id'],
                'company_id'=>company_info()['user_id'],
            ]);
            if(!empty(company_info()['subscription_id']) && $currentSubInfo->subscription_end_date > Carbon::now()) {
                $endingDate = strtotime("+$selectedTariffMonth months",strtotime($currentSubInfo->subscription_end_date));
                $session->set('tariff_finishing_date',date('Y-m-d H:i:s',$endingDate));
                $finishingDate =date('d-m-Y H:i:s',$endingDate);
            } else {
                $endingDate =  Carbon::now()->addMonths($selectedTariff->months_quantity);
                $session->set('tariff_finishing_date',date('Y-m-d H:i:s',$endingDate));
                $finishingDate = $endingDate->format('d-m-Y H:i:s');
            }

            $invoice = time();
            $selectedAditionalUsers = array(
                'dispatcher'=>$post['User']['dispatcher'],
                'accountant'=>$post['User']['accountant'],
                'safety_specialist'=>$post['User']['safety'],
                'driver'=>$post['User']['driver'],
            );

            $session->set('additionalUsers',$selectedAditionalUsers);
            $session->set('tariff_id',$selectedTariff->id);
            return $this->render('invoice',[
                'selectedTariff'=>$selectedTariff,
                'additionalUsers'=>$selectedAditionalUsers,
                'invoice'=>$invoice,
                'finishingDate'=>$finishingDate,
            ]);
        }
        else {
            throw new \yii\web\HttpException(401, 'Request must be from POST!');
        }
    }

    public function actionPayTariff()
    {
        /*agar user hali tarifdagi vaqti tugamasdan, qayta tarif sotib olsa, osha tarifini tugayotgan vaqtidan boshqab qoshishi kerak!*/

        $session = Yii::$app->session;
        if ($post = Yii::$app->request->post()) {

            $users = $session->get('additionalUsers');
            $keys = array_keys($users);
            $values = array_values($users);

            if ($session->isActive) {
                /*userni subscriptioni kiritib olamiz*/
                $tariff = Tariffs::findOne($session->get('tariff_id'));
                $subscriptions = new Subscriptions();
                $subscriptions->tariff_id = $session->get('tariff_id');
                $subscriptions->company_id = current_user_id();
                $subscriptions->subscription_start_date = Carbon::now();
                $subscriptions->subscription_end_date = $session->get('tariff_finishing_date');
                $subscriptions->overall_price = $session->get('overall_price');
                $subscriptions->save(false);
                /*tarifdan tashqari qoshimcha userlar olganda*/
                foreach ($keys as $index => $key) {
                    if($values[$index]>0) {
                        $subscriptionAdditionalUsers = new AdditionalUsersTable();
                        $subscriptionAdditionalUsers->subscription_id = $subscriptions->id;
                        $subscriptionAdditionalUsers->role = $key;
                        $subscriptionAdditionalUsers->quantity = $values[$index];
                        $subscriptionAdditionalUsers->price =  extraUserPrices(trim($key))*$values[$index];
                        $subscriptionAdditionalUsers->save(false);
                    }
                }
                /*profilga active tarifini kiritib qoyamiz*/
                $companyProfile = CompanyProfile::findOne(['user_id'=>current_user()]);
                $companyProfile->free_trial = 0;
                $companyProfile->subscription_id = $subscriptions->id;
                $companyProfile->save(false);

                /*saqlab olingan vaqtinchalik malumotlarni olib tashlaymiz*/
                $session->remove('additionalUsers');
                $session->remove('tariff_id');
                $session->remove('overall_price');
                $session->remove('tariff_finishing_date');

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
