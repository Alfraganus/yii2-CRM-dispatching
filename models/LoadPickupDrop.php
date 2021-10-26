<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "load_pickup_drop".
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $load_id
 * @property string|null $datetime
 * @property string|null $load_type
 *
 * @property CompanyProfile $company
 * @property Loads $load
 */
class LoadPickupDrop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'load_pickup_drop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'load_id'], 'integer'],
            [['datetime'], 'safe'],
            [['load_type'], 'string'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['load_id'], 'exist', 'skipOnError' => true, 'targetClass' => Loads::className(), 'targetAttribute' => ['load_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('loads', 'ID'),
            'company_id' => Yii::t('loads', 'Company ID'),
            'load_id' => Yii::t('loads', 'Load ID'),
            'datetime' => Yii::t('loads', 'Datetime'),
            'load_type' => Yii::t('loads', 'Load Type'),
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
     * Gets query for [[Load]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoad()
    {
        return $this->hasOne(Loads::className(), ['id' => 'load_id']);
    }
}
