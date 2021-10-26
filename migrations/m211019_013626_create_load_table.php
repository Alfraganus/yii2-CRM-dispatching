<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load}}`.
 */
class m211019_013626_create_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%loads}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->null(),
            'broker_id' => $this->integer()->null(),
            'load_id' => $this->integer(),
            'po_number' => $this->string(200),
            'commodity' => $this->string(255),
            'loaded_mile' => $this->double()->null(),
            'total_rate' => $this->double()->null(),
            'upload_rate_confirm' => $this->string(255),
            'upload_bol' => $this->double(),
            'is_assigned'=>$this->boolean()->null()
        ]);

        $this->addForeignKey(
            'fk_loads_company_id',
            'loads',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_loads_broker_id',
            'loads',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%load_pickup_drop}}', [
            'id' => $this->primaryKey(),
            'company_id'=>$this->integer()->null(),
            'load_id'=>$this->integer()->null(),
            'datetime'=>$this->dateTime()->null(),
            'load_type'=> "ENUM('pickup', 'drop-off')",
        ]);
        $this->addForeignKey(
            'fk_load_pick_drop_load_id',
            'load_pickup_drop',
            'load_id',
            'loads',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_load_pick_drop_company_id',
            'load_pickup_drop',
            'company_id',
            'company_profile',
            'id',
            'CASCADE'
        );


        $this->createTable('{{%load_assignees}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->null(),
            'carrier_id'=> $this->integer()->null(),
            'driver_id'=> $this->integer()->null(),
        ]);




    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_loads_company_id',
            'loads',
        );
        $this->dropForeignKey(
            'fk_loads_broker_id',
            'loads',
        );
        $this->dropForeignKey(
            'fk_load_pick_drop_company_id',
            'load_pickup_drop',
        );
        $this->dropForeignKey(
            'fk_load_pick_drop_load_id',
            'load_pickup_drop',
        );

        $this->dropTable('{{%load}}');
        $this->dropTable('{{%load_pickup_drop}}');
    }
}
