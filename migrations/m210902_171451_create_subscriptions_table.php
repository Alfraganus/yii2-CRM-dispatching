<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscriptions}}`.
 */
class m210902_171451_create_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscriptions}}', [
            'id' => $this->primaryKey(),
            'tariff_id'=>$this->integer()->null(),
            'company_id'=>$this->integer()->null(),
            'subscription_start_date'=>$this->dateTime()->null(),
            'subscription_end_date'=>$this->dateTime()->null(),
            'overall_price'=>$this->double()->null()
        ]);

        $this->addForeignKey(
            'fk_subscriptions_additional_users_id',
            'subscriptions',
            'company_id',
            'company_profile',
            'user_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_subscriptions_company_id',
            'subscriptions',
            'company_id',
            'company_profile',
            'user_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_subscriptions_tariff_id',
            'subscriptions',
            'tariff_id',
            'tariffs',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_subscriptions_company_id',
            'subscriptions',
        );

        $this->dropForeignKey(
            'fk_subscriptions_tariff_id',
            'subscriptions',
        );

        $this->dropTable('{{%subscriptions}}');
    }
}
