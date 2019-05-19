<?php

namespace app\models;

use Yii;
use app\models\OrderProduct;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\AttributesBehavior;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $date
 *
 * @property OrderProduct[] $orderProducts
 */
class Order extends ActiveRecord
{
    public $products;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    public function behaviors()
    {
      return [
          [
            'class' => AttributesBehavior::className(),
            'attributes' => [
              'date' => [
                ActiveRecord::EVENT_BEFORE_INSERT => new Expression('NOW()')
              ],
            ],
          ]
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Data do Pedido',
            'products' => 'Produtos'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['idOrder' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }
}
