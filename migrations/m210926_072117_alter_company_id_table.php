<?php

use yii\db\Migration;

/**
 * Class m210926_072117_alter_company_id_table
 */
class m210926_072117_alter_company_id_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*fix subscription company id*/
        $this->dropForeignKey(
            'fk_subscriptions_company_id',
            'subscriptions',
        );
        $this->addForeignKey(
            'fk_subscriptions_company_id',
            'subscriptions',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

      /*  brokers table*/
        $this->addColumn('brokers','company_id','integer');
        $this->addForeignKey(
            'fk_brokers_users_id',
            'brokers',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

        $this->dropForeignKey(
            'fk_cariers_company_id',
            'cariers',
        );
        $this->addForeignKey(
            'fk_cariers_company_id',
            'cariers',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

        $this->dropForeignKey(
            'fk_drivers_company_id',
            'drivers',
        );
        $this->addForeignKey(
            'fk_drivers_company_id',
            'drivers',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

        /*user uploadedga qoshamiz*/

        $this->addForeignKey(
            'fk_user_uploaded_documents_company_id',
            'user_uploaded_documents',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

        /*$this->addForeignKey(
            'fk_profile_company_id',
            'user_profile',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );*/


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210926_072117_alter_company_id_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210926_072117_alter_company_id_table cannot be reverted.\n";

        return false;
    }
    */
}
