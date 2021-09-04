<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_profile".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $free_trial
 * @property string $company_name
 * @property string|null $address
 * @property string|null $phone
 * @property string $email
 * @property string $free_triel_end_date
 * @property string $free_triel_start_date
 * @property string|null $owner_contact_info
 *
 * @property User $user
 */
class CompanyProfile extends \yii\db\ActiveRecord
{

    CONST TRIAL_ACTIVE = 1;
    CONST TRIAL_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['company_name'], 'required'],
            [['owner_contact_info'], 'string'],
            [['company_name', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 200],
            [['free_triel_end_date'], 'safe'],
            [['free_trial'], 'integer','max' => 1],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('auth', 'ID'),
            'user_id' => Yii::t('auth', 'User ID'),
            'company_name' => Yii::t('auth', 'Company Name'),
            'address' => Yii::t('auth', 'Address'),
            'phone' => Yii::t('auth', 'Phone'),
            'owner_contact_info' => Yii::t('auth', 'Owner Contact Info'),
        ];
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
