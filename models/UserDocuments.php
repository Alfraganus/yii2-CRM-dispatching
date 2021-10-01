<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_documents".
 *
 * @property int $id
 * @property int|null $document_category_id
 * @property string|null $user_role
 * @property string|null $required_document_name
 *
 * @property DocumentCategory $documentCategory
 */
class UserDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_documents';
    }


    CONST TYPE_FILE = 'file';
    CONST TYPE_TEXTINPUT = 'text';
    CONST TYPE_DATE = 'date';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_category_id'], 'integer'],
            [['user_role'], 'string', 'max' => 200],
            [['required_document_name'], 'string', 'max' => 255],
            [['document_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentCategory::className(), 'targetAttribute' => ['document_category_id' => 'id']],
        ];
    }

    public static function documentTypes()
    {
        return [
            self::TYPE_FILE=> self::TYPE_FILE,
            self::TYPE_TEXTINPUT=> self::TYPE_TEXTINPUT,
            self::TYPE_DATE=> self::TYPE_DATE,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('documents', 'ID'),
            'document_category_id' => Yii::t('documents', 'Document Category ID'),
            'user_role' => Yii::t('documents', 'User Role'),
            'required_document_name' => Yii::t('documents', 'Required Document Name'),
        ];
    }

    public static function checkIfFileAlreadyExist($user_id,$document_child_id)
    {
        $document = UserUploadedDocuments::find()
            ->where([ 'user_id' => $user_id, 'document_child_id' => $document_child_id])
            ->exists();
        if($document) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets query for [[DocumentCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentCategory()
    {
        return $this->hasOne(DocumentCategory::className(), ['id' => 'document_category_id']);
    }
    public function getDocumentChildren()
    {
        return $this->hasMany(DocumentsContent::className(), ['document_id' => 'id']);
    }
}
