<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "today_board_status".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $status
 *
 * @property CompanyProfile $company
 */
class TodayBoardStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'today_board_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('status', 'ID'),
            'company_id' => Yii::t('status', 'Company ID'),
            'status' => Yii::t('status', 'Status'),
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
}
