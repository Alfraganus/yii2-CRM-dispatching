<?php

use yii\db\Migration;

/**
 * Class m210921_170951_alter_carrier_table
 */
class m210921_170951_alter_carrier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cariers','user_id','integer');
        $this->addForeignKey(
            'fk-cariers-user_id',
            'cariers',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210921_170951_alter_carrier_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210921_170951_alter_carrier_table cannot be reverted.\n";

        return false;
    }
    */
}
