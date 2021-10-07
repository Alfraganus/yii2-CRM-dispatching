<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_content".
 *
 * @property int $id
 * @property int|null $document_id
 * @property string|null $document_type
 * @property string|null $document_name
 * @property int|null $company_id
 *
 * @property CompanyProfile $company
 * @property UserDocuments $document
 */
class DocumentsContent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_id', 'company_id','document_category'], 'integer'],
            [['document_type','role'], 'string', 'max' => 150],
            [['document_name'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserDocuments::className(), 'targetAttribute' => ['document_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('documents', 'ID'),
            'document_id' => Yii::t('documents', 'Document ID'),
            'document_type' => Yii::t('documents', 'Document Type'),
            'document_name' => Yii::t('documents', 'Document name'),
            'company_id' => Yii::t('documents', 'Company ID'),
            'document_category' => Yii::t('documents', 'Category'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(CompanyProfile::className(), ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Document]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(UserDocuments::className(), ['id' => 'document_id']);
    }
}
