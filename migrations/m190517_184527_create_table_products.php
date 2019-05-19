<?php

use yii\db\Migration;

/**
 * Class m190517_184527_create_table_products
 */
class m190517_184527_create_table_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('product', [
        'id' => $this->primaryKey(),
        'name' => $this->string(100)->notNull(),
        'description' => $this->text(),
        'price' => $this->decimal(10,2)->notNull(),
        'sku' => $this->string(100)->notNull(),
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190517_184527_create_table_product cannot be reverted.\n";
        return $this->dropTable('product');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190517_184527_create_table_products cannot be reverted.\n";

        return false;
    }
    */
}
