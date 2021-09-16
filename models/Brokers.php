<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "brokers".
 *
 * @property int $id
 * @property string|null $broker_name
 * @property string|null $broker_state
 * @property string|null $broker_city
 * @property string|null $broker_zip
 * @property string|null $broker_phone
 * @property string|null $broker_fax
 * @property string|null $broker_email
 * @property string|null $broker_contact_person
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Brokers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brokers';
    }

    public $phone;
    public $phone_extention;
    public $phone_direct_line;
    public $cell_phone;
    public $email;

    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone','phone_extention','phone_direct_line','cell_phone','email'], 'safe'],
            [['broker_contact_person'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['broker_name', 'broker_state', 'broker_city', 'broker_zip', 'broker_phone', 'broker_fax', 'broker_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('broker', 'ID'),
            'broker_name' => Yii::t('broker', 'Broker Name'),
            'broker_state' => Yii::t('broker', 'Broker State'),
            'broker_city' => Yii::t('broker', 'Broker City'),
            'broker_zip' => Yii::t('broker', 'Broker Zip'),
            'broker_phone' => Yii::t('broker', 'Broker Phone'),
            'broker_fax' => Yii::t('broker', 'Broker Fax'),
            'broker_email' => Yii::t('broker', 'Broker Email'),
            'broker_contact_person' => Yii::t('broker', 'Broker Contact Person'),
            'status' => Yii::t('broker', 'Status'),
            'created_by' => Yii::t('broker', 'Created By'),
            'updated_by' => Yii::t('broker', 'Updated By'),
        ];
    }
    
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors = ArrayHelper::merge(
            $behaviors,
            [
                'attributeStamp' => [
                    'class' => BlameableBehavior::class,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => 'created_by',
                        ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_by',
                    ],
                    'value' => function ($event) {
                        return Yii::$app->user->id;
                    },
                ],

            ]
        );
        return $behaviors;
    }
    
}
