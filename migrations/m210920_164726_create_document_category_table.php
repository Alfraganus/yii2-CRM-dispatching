<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%document_category}}`.
 */
class m210920_164726_create_document_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%document_category}}', [
            'id' => $this->primaryKey(),
            'document_category'=>$this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%document_category}}');
    }
}
