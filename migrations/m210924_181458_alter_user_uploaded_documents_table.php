<?php

use yii\db\Migration;

/**
 * Class m210924_181458_alter_user_uploaded_documents_table
 */
class m210924_181458_alter_user_uploaded_documents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_uploaded_documents','document','text');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210924_181458_alter_user_uploaded_documents_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210924_181458_alter_user_uploaded_documents_table cannot be reverted.\n";

        return false;
    }
    */
}
