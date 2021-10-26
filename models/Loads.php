<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loads".
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $broker_id
 * @property int|null $load_id
 * @property string|null $po_number
 * @property string|null $commodity
 * @property float|null $loaded_mile
 * @property float|null $total_rate
 * @property string|null $upload_rate_confirm
 * @property float|null $upload_bol
 * @property int|null $is_assigned
 *
 * @property CompanyProfile $company
 * @property CompanyProfile $company0
 * @property LoadPickupDrop[] $loadPickupDrops
 */
class Loads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'broker_id', 'load_id', 'is_assigned'], 'integer'],
            [['loaded_mile', 'total_rate', 'upload_bol'], 'number'],
            [['po_number'], 'string', 'max' => 200],
            [['commodity', 'upload_rate_confirm'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'id']],
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
            'broker_id' => Yii::t('loads', 'Broker ID'),
            'load_id' => Yii::t('loads', 'Load ID'),
            'po_number' => Yii::t('loads', 'Po Number'),
            'commodity' => Yii::t('loads', 'Commodity'),
            'loaded_mile' => Yii::t('loads', 'Loaded Mile'),
            'total_rate' => Yii::t('loads', 'Total Rate'),
            'upload_rate_confirm' => Yii::t('loads', 'Upload Rate Confirm'),
            'upload_bol' => Yii::t('loads', 'Upload Bol'),
            'is_assigned' => Yii::t('loads', 'Is Assigned'),
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
     * Gets query for [[Company0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany0()
    {
        return $this->hasOne(CompanyProfile::className(), ['id' => 'company_id']);
    }

    /**
     * Gets query for [[LoadPickupDrops]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoadPickupDrops()
    {
        return $this->hasMany(LoadPickupDrop::className(), ['load_id' => 'id']);
    }
}
