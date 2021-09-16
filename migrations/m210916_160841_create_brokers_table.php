<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%brokers}}`.
 */
class m210916_160841_create_brokers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%brokers}}', [
            'id' => $this->primaryKey(),
            'broker_name'=>$this->string(255)->null(),
            'broker_state'=>$this->string(255)->null(),
            'broker_city'=>$this->string(255)->null(),
            'broker_zip'=>$this->string(255)->null(),
            'broker_phone'=>$this->string(255)->null(),
            'broker_fax'=>$this->string(255)->null(),
            'broker_email'=>$this->string(255)->null(),
            'broker_contact_person'=>$this->text()->null(),
            'status'=>$this->integer()->defaultValue(1)->null(),
            'created_by'=>$this->integer()->null(),
            'updated_by'=>$this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%brokers}}');
    }
}
