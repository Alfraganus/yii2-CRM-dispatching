<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%today_board_status}}`.
 */
class m210927_162827_create_today_board_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%today_board_status}}', [
            'id' => $this->primaryKey(),
            'company_id'=>$this->integer()->null(),
            'status'=>$this->string(255)
        ]);

        $this->addForeignKey(
        'fk_today_board_status_company_id',
        'today_board_status',
        'company_id',
        'company_profile',
        'id',
        'CASCADE'
    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%today_board_status}}');
    }
}
