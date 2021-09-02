<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aditional_users_table}}`.
 */
class m210902_171543_create_aditional_users_table_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%additional_users_table}}', [
            'id' => $this->primaryKey(),
            'subscription_id'=>$this->integer()->null(),
            'role'=>$this->string(150)->notNull(),
            'quantity'=>$this->integer()->notNull(),
            'price'=>$this->double()->null()
        ]);

        $this->addForeignKey(
            'fk_additional_users_subscription_id',
            'additional_users_table',
            'subscription_id',
            'subscriptions',
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
            'fk_additional_users_subscription_id',
            'additional_users_table',
        );
        $this->dropTable('{{%additional_users_table}}');
    }
}
