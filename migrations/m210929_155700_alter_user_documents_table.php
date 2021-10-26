<?php

use yii\db\Migration;

/**
 * Class m210929_155700_alter_user_documents_table
 */
class m210929_155700_alter_user_documents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%documents_content}}', [
            'id' => $this->primaryKey(),
            'document_id'=>$this->integer()->null(),
            'document_type'=>$this->string(150)->null(),
            'document_name'=>$this->string(255)->null(),
            'company_id'=>$this->integer()->null(),
        ]);
        $this->addColumn('user_documents','company_id','integer');

        $this->addForeignKey(
            'fk_user_documents_company_id',
            'user_documents',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_documents_content_company_id',
            'documents_content',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_documents_content_document_id',
            'documents_content',
            'document_id',
            'user_documents',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210929_155700_alter_user_documents_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210929_155700_alter_user_documents_table cannot be reverted.\n";

        return false;
    }
    */
}
