<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "drivers".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $carrier_id
 * @property string|null $driver_fullname
 *
 * @property Cariers $carrier
 * @property User $user
 */
class Drivers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drivers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'carrier_id'], 'integer'],
            [['driver_fullname'], 'string', 'max' => 255],
            [['carrier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cariers::className(), 'targetAttribute' => ['carrier_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('driver', 'ID'),
            'user_id' => Yii::t('driver', 'User ID'),
            'carrier_id' => Yii::t('driver', 'Carrier ID'),
            'driver_fullname' => Yii::t('driver', 'Driver Fullname'),
        ];
    }




    /**
     * Gets query for [[Carrier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrier()
    {
        return $this->hasOne(Cariers::className(), ['id' => 'carrier_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
