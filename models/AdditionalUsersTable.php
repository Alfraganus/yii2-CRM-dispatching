<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "additional_users_table".
 *
 * @property int $id
 * @property int|null $subscription_id
 * @property string $role
 * @property int $quantity
 * @property float|null $price
 *
 * @property Subscriptions $subscription
 */
class AdditionalUsersTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'additional_users_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subscription_id', 'quantity'], 'integer'],
            [['role', 'quantity'], 'required'],
            [['price'], 'number'],
            [['role'], 'string', 'max' => 150],
            [['subscription_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subscriptions::className(), 'targetAttribute' => ['subscription_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'subscription_id' => Yii::t('user', 'Subscription ID'),
            'role' => Yii::t('user', 'Role'),
            'quantity' => Yii::t('user', 'Quantity'),
            'price' => Yii::t('user', 'Price'),
        ];
    }

    /**
     * Gets query for [[Subscription]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubscription()
    {
        return $this->hasOne(Subscriptions::className(), ['id' => 'subscription_id']);
    }
}
