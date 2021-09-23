<?php

use yii\db\Migration;

/**
 * Class m210923_172028_driver_carrier_table
 */
class m210923_172028_driver_carrier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cariers','company_id','integer');
        $this->addColumn('drivers','company_id','integer');

        $this->addForeignKey(
            'fk_cariers_company_id',
            'cariers',
            'company_id',
            'company_profile',
            'user_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_drivers_company_id',
            'drivers',
            'company_id',
            'company_profile',
            'user_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210923_172028_driver_carrier_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210923_172028_driver_carrier_table cannot be reverted.\n";

        return false;
    }
    */
}
