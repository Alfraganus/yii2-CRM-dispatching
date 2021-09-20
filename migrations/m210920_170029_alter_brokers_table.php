<?php

use yii\db\Migration;

/**
 * Class m210920_170029_alter_brokers_table
 */
class m210920_170029_alter_brokers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('brokers','mc','string');
        $this->dropColumn('brokers','broker_state');
        $this->dropColumn('brokers','broker_city');
        $this->dropColumn('brokers','broker_zip');
        $this->addColumn('brokers','broker_address','string');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210920_170029_alter_brokers_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210920_170029_alter_brokers_table cannot be reverted.\n";

        return false;
    }
    */
}
