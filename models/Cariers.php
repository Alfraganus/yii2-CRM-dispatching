<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cariers".
 *
 * @property int $id
 * @property string|null $carrier_name
 * @property string|null $carrier_info
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Cariers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cariers';
    }
    const ACTIVE =1;
    const INACTIVE =0;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carrier_info'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['carrier_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('carrier', 'ID'),
            'carrier_name' => Yii::t('carrier', 'Carrier Name'),
            'carrier_info' => Yii::t('carrier', 'Carrier Info'),
            'status' => Yii::t('carrier', 'Status'),
            'created_by' => Yii::t('carrier', 'Created By'),
            'updated_by' => Yii::t('carrier', 'Updated By'),
        ];
    }
}
