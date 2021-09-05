<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tariffs".
 *
 * @property int $id
 * @property string $tariff_name
 * @property string $description
 * @property int $months_quantity
 * @property float|null $price
 * @property float|null $discount
 * @property int|null $active
 *
 * @property Subscriptions[] $subscriptions
 */
class Tariffs extends \yii\db\ActiveRecord
{

    CONST ACTIVE = 1;
    CONST INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tariffs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tariff_name', 'description', 'months_quantity'], 'required'],
            [['description'], 'string'],
            [['months_quantity', 'active','accountant','safety_specialist','dispatcher','driver'], 'integer'],
            [['price', 'discount'], 'number'],
            [['tariff_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tariff', 'ID'),
            'tariff_name' => Yii::t('tariff', 'Tariff Name'),
            'description' => Yii::t('tariff', 'Description'),
            'months_quantity' => Yii::t('tariff', 'Months Quantity'),
            'price' => Yii::t('tariff', 'Price'),
            'discount' => Yii::t('tariff', 'Discount'),
            'active' => Yii::t('tariff', 'Active'),
        ];
    }

    /**
     * Gets query for [[Subscriptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscriptions::className(), ['tariff_id' => 'id']);
    }
}
