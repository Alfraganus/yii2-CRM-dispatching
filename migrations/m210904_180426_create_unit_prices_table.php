<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%unit_prices}}`.
 */
class m210904_180426_create_unit_prices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%unit_prices}}', [
            'id' => $this->primaryKey(),
            'unit_key'=>$this->string(150)->null(),
            'unit_value'=>$this->double()->null(),
            'active'=>$this->integer()->defaultValue(1)->null()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%unit_prices}}');
    }
}
