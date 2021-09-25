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

    public function actionDocuments($user_id=33)
    {
        $documentsToSubmit = getUserSubmittedDocuments($user_id,15,'driver');
        $model = new DynamicModel(['file']);
        $model->addRule(['file'], 'safe');
        $userUnsubmittedDocuments = getUserUnsubmittedDocuments($user_id,15,'driver');
        if ($post = Yii::$app->request->post()) {

            foreach ($documentsToSubmit as $index => $doc) {
                $file = UploadedFile::getInstance($model, "file[$index]");

                $userUploadedDocuments = new UserUploadedDocuments();
                $userUploadedDocuments->company_id = 15;
                $userUploadedDocuments->user_id = 33;
                $userUploadedDocuments->role = 'driver';
                $userUploadedDocuments->document_category_id = 1;
                $userUploadedDocuments->document_id = 1;
                $userUploadedDocuments->document = $file->name;
                $userUploadedDocuments->save();
                $file->saveAs('uploaded_documents/'.$file->name);
 
            }
            return  $this->redirect(['safety/']);

        }
        return $this->render('documents',[
            'documentsToSubmit'=>$documentsToSubmit,
            'model'=>$model,
            'userUnsubmittedDocuments'=>$userUnsubmittedDocuments
        ]);
    }

}
