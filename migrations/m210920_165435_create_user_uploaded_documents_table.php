<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_uploaded_documents}}`.
 */
class m210920_165435_create_user_uploaded_documents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_uploaded_documents}}', [
            'id' => $this->primaryKey(),
            'company_id'=>$this->integer()->null(),
            'user_id'=>$this->integer()->null(),
            'role'=>$this->string(100)->null(),
            'document_category_id'=>$this->integer(),
            'document_id'=>$this->integer(),
            'created_at'=>$this->timestamp()->null(),
            'created_by'=>$this->integer()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_uploaded_documents}}');
    }
}
