<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 *
 */
class Product extends  ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Product}}';
    }

    public function attributeLabels()
    {
      return [
        'name' => 'Nome',
        'description' => 'Descrição',
        'price' => 'Preço',
        'sku' => 'SKU'
      ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['name', 'price', 'sku'], 'required'],
          ['name', 'string', 'max' => 100],
          ['sku', 'string'],
          ['description', 'string'],
          ['price', 'double', 'min' => 0],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['idProduct' => 'id']);
    }
}
