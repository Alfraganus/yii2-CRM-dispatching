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
class SafetyController extends Controller
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
    private $company_id;
    public function __construct($id, $module, $config = [])
    {
        if(getUserRole() == 'cadmin') {
            $this->company_id = company_info()['id'];
        } else {
            $this->company_id = getTeamUserCompanyInfo(current_user_id())['id'];
        }
        parent::__construct($id, $module, $config);
    }

    /**
     * Lists all Drivers models.
     * @return mixed
     */

    private function getDrivers()
    {
        $company_id = getTeamUserCompanyInfo(current_user_id());
        return getDriversByCompany($company_id->id);
    }

    public function actionIndex()
    {
        $drivers = $this->getDrivers();
        $numOfDocuments = documents_needed_to_submit('driver', true,1);
        return $this->render('index', [
            'drivers' => $drivers,
            'numOfDocuments' => $numOfDocuments,
            'company_id' => $this->company_id,
        ]);
    }

    public function actionDriverVehicleInfo()
    {
        $carriers = queryMaster('cariers',true,['company_id'=>$this->company_id]);
        $numOfDocuments = documents_needed_to_submit('carrier', true,2);

        return $this->render('driver_vehicle',[
            'carriers' => $carriers,
            'numOfDocuments' => $numOfDocuments,
            'company_id' => $company_id->id,
        ]);
    }



}
