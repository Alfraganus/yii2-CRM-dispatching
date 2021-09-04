<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unit_prices".
 *
 * @property int $id
 * @property string|null $unit_key
 * @property float|null $unit_value
 * @property int|null $active
 */
class UnitPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_value'], 'number'],
            [['active'], 'integer'],
            [['unit_key'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('price', 'ID'),
            'unit_key' => Yii::t('price', 'Unit Key'),
            'unit_value' => Yii::t('price', 'Unit Value'),
            'active' => Yii::t('price', 'Active'),
        ];
    }
}
