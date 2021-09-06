    <?php

use yii\db\Migration;

/**
 * Class m210906_174643_alter_company_profile_table
 */
class m210906_174643_alter_company_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('auth_assignment','token','string');
        $this->addColumn('company_profile','subscription_id','integer');
        $this->addForeignKey(
            'fk-company_profile-subscription_id',
            'company_profile',
            'subscription_id',
            'subscriptions',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210906_174643_alter_company_profile_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210906_174643_alter_company_profile_table cannot be reverted.\n";

        return false;
    }
    */
}
