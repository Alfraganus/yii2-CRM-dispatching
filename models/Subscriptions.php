<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscriptions".
 *
 * @property int $id
 * @property int|null $tariff_id
 * @property int|null $company_id
 * @property string|null $subscription_start_date
 * @property string|null $subscription_end_date
 * @property float|null $overall_price
 *
 * @property AdditionalUsersTable[] $additionalUsersTables
 * @property CompanyProfile $company
 * @property CompanyProfile $company0
 * @property Tariffs $tariff
 */
class Subscriptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tariff_id', 'company_id'], 'integer'],
            [['subscription_start_date', 'subscription_end_date'], 'safe'],
            [['overall_price'], 'number'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'user_id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'user_id']],
            [['tariff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tariffs::className(), 'targetAttribute' => ['tariff_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('subscriptions', 'ID'),
            'tariff_id' => Yii::t('subscriptions', 'Tariff ID'),
            'company_id' => Yii::t('subscriptions', 'Company ID'),
            'subscription_start_date' => Yii::t('subscriptions', 'Subscription Start Date'),
            'subscription_end_date' => Yii::t('subscriptions', 'Subscription End Date'),
            'overall_price' => Yii::t('subscriptions', 'Overall Price'),
        ];
    }

    /**
     * Gets query for [[AdditionalUsersTables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalUsersTables()
    {
        return $this->hasMany(AdditionalUsersTable::className(), ['subscription_id' => 'id']);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(CompanyProfile::className(), ['user_id' => 'company_id']);
    }

    /**
     * Gets query for [[Company0]].
     *
     * @return \yii\db\ActiveQuery
     */


    /**
     * Gets query for [[Tariff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTariff()
    {
        return $this->hasOne(Tariffs::className(), ['id' => 'tariff_id']);
    }
}
