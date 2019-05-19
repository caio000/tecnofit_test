<?php

use yii\db\Migration;

/**
 * Class m190519_122726_create_table_order_product
 */
class m190519_122726_create_table_order_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('order_product', [
        'id' => $this->primaryKey(),
        'idOrder' => $this->integer()->notNull(),
        'idProduct' => $this->integer()->notNull(),
      ]);

      $this->addForeignKey('fk_order', 'order_product', 'idOrder', 'order', 'id');
      $this->addForeignKey('fk_product', 'order_product', 'idProduct', 'product', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190519_122726_create_table_order_product cannot be reverted.\n";

        return $this->dropTable('order_product');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190519_122726_create_table_order_product cannot be reverted.\n";

        return false;
    }
    */
}
