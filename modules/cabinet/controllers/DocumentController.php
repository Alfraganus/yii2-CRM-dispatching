<?php

namespace app\modules\cabinet\controllers;

use app\models\CompanyProfile;
use app\models\Drivers;
use app\models\search\DriversSearch;
use app\models\User;
use app\models\UserUploadedDocuments;
use Carbon\Carbon;
use DomainException;
use Yii;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class DocumentController extends Controller
{

    private $company_id;
    private $isSafety;

    public function __construct($id, $module, $config = [])
    {
        $userRole = getUserRole();
        if ($userRole == 'safety_specialist') {
        $this->isSafety = 1;
        $this->company_id = $getUserDirectory = getTeamUserCompanyInfo(current_user_id())['id'];
            if (!is_dir("uploaded_documents/$getUserDirectory") ) {
                mkdir('uploaded_documents'.DIRECTORY_SEPARATOR.$getUserDirectory);
            }
        } else {
            Yii::$app->session->setFlash('danger','You are not safety specialist, please contact administrator for more information!');
           $this->isSafety = 0;
        }
        parent::__construct($id, $module, $config);
    }

    public function actionDocuments($user_id)
    {
        $company_id = getTeamUserCompanyInfo(current_user_id())['id'];
//        var_dump($company_id); die;
        $documentsToSubmit = getUserSubmittedDocuments($user_id,$company_id,'driver');
        $model = new DynamicModel(['file','document_category_id','document_id']);
        $model->addRule(['file','document_category_id','document_id'], 'safe');
        $userUnsubmittedDocuments = getUserUnsubmittedDocuments($user_id,$company_id,'driver');
        if ($model->load($this->request->post())) {

            foreach ($userUnsubmittedDocuments as $index => $doc) {
                $file = UploadedFile::getInstance($model, "file[$index]");
                if ($file) {
                    $fileName = time().$file->name;
                    $fullPath = 'uploaded_documents'.'/'.$this->company_id.'/'.$fileName;
                    $userUploadedDocuments = new UserUploadedDocuments();
                    $userUploadedDocuments->company_id = $company_id;
                    $userUploadedDocuments->user_id = $user_id;
                    $userUploadedDocuments->created_at = date('Y-m-d H:i:s');
                    $userUploadedDocuments->role = 'driver';
                    $userUploadedDocuments->document_category_id = $model->document_category_id[$index];
                    $userUploadedDocuments->document_id =  $model->document_id[$index];
                    $userUploadedDocuments->document = '/web/'.$fullPath;
                    $userUploadedDocuments->save();
                    $file->saveAs($fullPath);
                }
            }
            return  $this->redirect(['safety/']);

        }
        return $this->render('documents',[
            'documentsToSubmit'=>$documentsToSubmit,
            'model'=>$model,
            'userUnsubmittedDocuments'=>$userUnsubmittedDocuments,
            'isSafety'=>$this->isSafety
        ]);
    }

}
