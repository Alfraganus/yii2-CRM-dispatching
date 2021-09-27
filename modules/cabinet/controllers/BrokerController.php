<?php

namespace app\modules\cabinet\controllers;

use app\models\Brokers;
use app\models\search\BrokersSearch;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
$service = Yii::$container->set('app\models\Brokers');


/**
 * BrokerController implements the CRUD actions for Brokers model.
 */
class BrokerController extends Controller
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

    public function actionTest(Brokers $brokers)
    {
        return $brokers->status;
    }


    /**
     * Lists all Brokers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BrokersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brokers model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $broker_data =json_decode($model->broker_contact_person);
        $model->phone = $broker_data->phone;
        $model->phone_extention= $broker_data->phone_extention;
        $model->phone_direct_line = $broker_data->phone_direct_line;
        $model->cell_phone = $broker_data->cell_phone;
        $model->email = $broker_data->email;

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Brokers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Brokers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $broker_contact = array(
                    'phone'=>$model->phone,
                    'phone_extention'=>$model->phone_extention,
                    'phone_direct_line'=>$model->phone_direct_line,
                    'cell_phone'=>$model->cell_phone,
                    'email'=>$model->email,
                );
                $model->broker_contact_person = Json::encode($broker_contact);
                $model->company_id =  company_name(false)->id;;
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('warning',$model->errors);
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Brokers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $broker_data =json_decode($model->broker_contact_person);
        $model->phone = $broker_data->phone;
        $model->phone_extention= $broker_data->phone_extention;
        $model->phone_direct_line = $broker_data->phone_direct_line;
        $model->cell_phone = $broker_data->cell_phone;
        $model->email = $broker_data->email;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $broker_contact = array(
                'phone'=>$model->phone,
                'phone_extention'=>$model->phone_extention,
                'phone_direct_line'=>$model->phone_direct_line,
                'cell_phone'=>$model->cell_phone,
                'email'=>$model->email,
            );
            $model->broker_contact_person = Json::encode($broker_contact);
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('warning',$model->errors);
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Brokers model.
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
     * Finds the Brokers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Brokers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brokers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('broker', 'The requested page does not exist.'));
    }
}
