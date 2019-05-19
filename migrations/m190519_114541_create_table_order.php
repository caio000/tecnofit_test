<?php

use yii\db\Migration;

/**
 * Class m190519_114541_create_table_order
 */
class m190519_114541_create_table_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('order', [
        'id' => $this->primaryKey(),
        'date' => $this->dateTime()->notNull(),
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190519_114541_create_table_order cannot be reverted.\n";

        return $this->dropTable('order');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190519_114541_create_table_order cannot be reverted.\n";

        return false;
    }
    */
}
