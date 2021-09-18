<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cariers}}`.
 */
class m210918_085742_create_cariers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cariers}}', [
            'id' => $this->primaryKey(),
            'carrier_name'=>$this->string(255),
            'carrier_info'=>$this->text()->null(),
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
        $this->dropTable('{{%cariers}}');
    }
}
