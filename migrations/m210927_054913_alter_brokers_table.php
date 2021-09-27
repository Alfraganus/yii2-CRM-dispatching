<?php

use yii\db\Migration;

/**
 * Class m210927_054913_alter_brokers_table
 */
class m210927_054913_alter_brokers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210927_054913_alter_brokers_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210927_054913_alter_brokers_table cannot be reverted.\n";

        return false;
    }
    */
}
