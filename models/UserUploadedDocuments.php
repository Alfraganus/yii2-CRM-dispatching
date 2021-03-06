<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user_uploaded_documents".
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $user_id
 * @property string|null $role
 * @property int|null $document_category_id
 * @property int|null $document_id
 * @property string|null $document
 * @property string|null $created_at
 * @property int|null $created_by
 */
class UserUploadedDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_uploaded_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'document_category_id', 'document_id', 'created_by'], 'integer'],
            [['created_at','document'], 'safe'],
            [['role'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('documents', 'ID'),
            'company_id' => Yii::t('documents', 'Company ID'),
            'user_id' => Yii::t('documents', 'User ID'),
            'role' => Yii::t('documents', 'Role'),
            'document_category_id' => Yii::t('documents', 'Document Category ID'),
            'document_id' => Yii::t('documents', 'Document ID'),
            'created_at' => Yii::t('documents', 'Created At'),
            'created_by' => Yii::t('documents', 'Created By'),
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors = ArrayHelper::merge(
            $behaviors,
            [
                'attributeStamp' => [
                    'class' => BlameableBehavior::class,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => 'created_by',
                    ],
                    'value' => function ($event) {
                        return Yii::$app->user->id;
                    },
                ],

            ]
        );
        return $behaviors;
    }

    public function getDocumentName()
    {
        return $this->hasOne(UserDocuments::className(), ['id' => 'document_id']);
    }
    public function getDocumentChildName()
    {
        return $this->hasOne(DocumentsContent::className(), ['document_id' => 'document_id']);
    }
}
