<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_documents}}`.
 */
class m210920_164809_create_user_documents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_documents}}', [
            'id' => $this->primaryKey(),
            'document_category_id'=>$this->integer(),
            'user_role'=>$this->string(200),
            'required_document_name'=>$this->string(255)
        ]);
        $this->addForeignKey(
            'fk-user_documents-document_category_id',
            'user_documents',
            'document_category_id',
            'document_category',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user_documents-document_category_id',
            'user_documents',
        );
        $this->dropTable('{{%user_documents}}');
    }
}
