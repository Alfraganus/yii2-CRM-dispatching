<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%drivers}}`.
 */
class m210918_130446_create_drivers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%drivers}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->null(),
            'carrier_id'=>$this->integer()->null(),
            'driver_fullname'=>$this->string(255),
        ]);
        $this->addForeignKey(
            'fk-drivers-user_id',
            'drivers',
            'user_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk-drivers-carrier_id',
            'drivers',
            'carrier_id',
            'cariers',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-drivers-user_id',
            'drivers'
        );

        $this->dropForeignKey(
            'fk-drivers-carrier_id',
            'drivers'
        );

        $this->dropTable('{{%drivers}}');
    }
}
