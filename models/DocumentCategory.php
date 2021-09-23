<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document_category".
 *
 * @property int $id
 * @property string|null $document_category
 *
 * @property UserDocuments[] $userDocuments
 */
class DocumentCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('documents', 'ID'),
            'document_category' => Yii::t('documents', 'Document Category'),
        ];
    }

    /**
     * Gets query for [[UserDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserDocuments()
    {
        return $this->hasMany(UserDocuments::className(), ['document_category_id' => 'id']);
    }
}
