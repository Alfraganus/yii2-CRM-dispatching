<?php

namespace app\modules\cabinet\controllers;

use app\models\CompanyProfile;
use app\models\Drivers;
use app\models\search\DriversSearch;
use app\models\User;
use app\models\UserDocuments;
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
        $documentsToSubmit = getUserSubmittedDocuments($user_id, $company_id, 'driver');
        $model = new DynamicModel(['file', 'document_category_id', 'document_id', 'document_type']);
        $model->addRule(['file', 'document_category_id', 'document_id', 'document_type'], 'safe');
        $userUnsubmittedDocuments = getUserUnsubmittedDocuments($user_id, $company_id, 'driver',1);

        $documentParent = UserDocuments::find()->where(['document_category_id'=>1])->all();
        if ($post = $model->load($this->request->post())) {
            foreach ($documentParent as $document) {
                foreach ($document->documentChildren as $index => $child) {
                    $id = $child->id;
                    $file = UploadedFile::getInstance($model, "file[$id]");
                    if (!empty($model->file[$id]) || $file) {
                        $userUploadedDocuments = new UserUploadedDocuments();
                        if ($child->document_type == UserDocuments::TYPE_DATE) {
                            $documentName = array(
                                'date' => array(
                                    'date' => $model->file[$id],
                                )
                            );
                            $userUploadedDocuments->document = $documentName;
                        } elseif ($child->document_type == UserDocuments::TYPE_TEXTINPUT) {
                            $documentName = array(
                                'text' => array(
                                    'text' => $model->file[$id],
                                )
                            );
                            $userUploadedDocuments->document = $documentName;
                        } elseif ($child->document_type == UserDocuments::TYPE_FILE) {
                            if ($file) {
                                $fullPath = 'uploaded_documents' . '/' . $this->company_id . '/' . time() . $file->name;
                                if ($file->saveAs($fullPath)) {
                                    $documentName = array(
                                        'file' => array(
                                            'path' => $fullPath,
                                        )
                                    );
                                    $userUploadedDocuments->document = $documentName;
                                }
                            }
                        }
                        $userUploadedDocuments->document_child_id = $id;
                        $userUploadedDocuments->company_id = $company_id;
                        $userUploadedDocuments->user_id = $user_id;
                        $userUploadedDocuments->created_at = date('Y-m-d H:i:s');
                        $userUploadedDocuments->role = 'driver';
                        $userUploadedDocuments->document_category_id = $model->document_category_id[$id];
                        $userUploadedDocuments->document_id = $model->document_id[$id];
                        $userUploadedDocuments->save();
                    }
                }
            }
            Yii::$app->session->setFlash('success','Documents have been successfully created!');
            return $this->redirect(['safety/']);

        }
        return $this->render('documents',[
            'documentsToSubmit'=>$documentsToSubmit,
            'model'=>$model,
            'userUnsubmittedDocuments'=>$userUnsubmittedDocuments,
            'isSafety'=>$this->isSafety,
            'documentParent'=>$documentParent
        ]);
    }



    public function actionCreteDriverVehicleInfo($user_id)
    {
        $documentsToSubmit = getUserSubmittedDocuments($user_id,$this->company_id,'driver');
        $model = new DynamicModel(['file','document_category_id','document_id','doc_name']);
        $model->addRule(['file','document_category_id','document_id','doc_name'], 'safe');
        $userUnsubmittedDocuments = getUserUnsubmittedDocuments($user_id,$this->company_id,'driver',2);
        if ($post = $model->load($this->request->post())) {

            foreach ($userUnsubmittedDocuments as $index => $doc) {
                $userUploadedDocuments = new UserUploadedDocuments();
                $userUploadedDocuments->company_id = $this->company_id;
                $userUploadedDocuments->user_id = $user_id;
                $userUploadedDocuments->role = 'driver';
                $userUploadedDocuments->document_category_id = $model->document_category_id[$index];
                $userUploadedDocuments->document_id = $model->document_id[$index];
                $userUploadedDocuments->document = [
                    $model->doc_name[$index]=>$model->file[$index]
                ];
                $userUploadedDocuments->save();

            }
            return  $this->redirect(['driver-vehicle-info/']);

        }
        return $this->render('driver_vehicle',[
            'documentsToSubmit'=>$documentsToSubmit,
            'model'=>$model,
            'userUnsubmittedDocuments'=>$userUnsubmittedDocuments
        ]);
    }


    public function actionViewVehicleDocument($user_id,$company_id,$role)
    {
        $documents = UserUploadedDocuments::findAll([
            'company_id'=>$company_id,
            'user_id'=>$user_id,
            'role'=>$role,
            'document_category_id'=>2,
        ]);

        return $this->render('view_documents',[
            'documents'=>$documents
        ]);
    }

    public function actionDownloadFile($id)
    {
        $download = UserUploadedDocuments::findOne($id);
        $path = Yii::getAlias('@webroot').$download->document;

        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path, $download->documentName->required_document_name);
        } else {
            Yii::$app->session->setFlash('danger','file does not exist!');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

}
