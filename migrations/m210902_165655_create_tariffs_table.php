<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tariffs}}`.
 */
class m210902_165655_create_tariffs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tariffs}}', [
            'id' => $this->primaryKey(),
            'tariff_name'=>$this->string(255)->notNull(),
            'description'=>$this->text()->notNull(),
            'months_quantity'=>$this->integer()->notNull(),
            'discount'=>$this->double()->null(),
            'price'=>$this->double()->null(),
            'active'=>$this->smallInteger(1)->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tariffs}}');
    }
}
