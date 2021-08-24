<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_profile".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $company_name
 * @property string|null $address
 * @property string|null $phone
 * @property string $email
 * @property string|null $owner_contact_info
 *
 * @property User $user
 */
class CompanyProfile extends \yii\db\ActiveRecord
{
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
            [['company_name', 'email'], 'required'],
            [['owner_contact_info'], 'string'],
            [['company_name', 'address', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 200],
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
            'email' => Yii::t('auth', 'Email'),
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
