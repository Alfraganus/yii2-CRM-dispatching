<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_subsctiptions}}`.
 */
class m210829_120736_create_company_subsctiptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_subscriptions}}', [
            'id' => $this->primaryKey(),
            'company_id'=>$this->integer()->null(),
            'start_date'=>$this->timestamp()->null(),
            'end_date'=>$this->timestamp()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company_subsctiptions}}');
    }
}
