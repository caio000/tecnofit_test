<?php

use app\assets\modal\ModalAsset;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseUrl;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
$idOrder = $model[0]->idOrder;
$this->title = "Pedido de número {$idOrder}";
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$formater = Yii::$app->formatter;

$modalFooter = Html::a('Não', '#', [
  'class' => 'btn btn-secondary',
  'data-dismiss' => 'modal'
]);

$modalFooter.= Html::a('Sim', '#', [
  'id' => 'btn-delete',
  'class' => 'btn btn-danger'
]);
$modalConfig = [
  'title' => 'Deletar Produto',
  'options' => ['id' => 'mdConfirm'],
  'footer' => $modalFooter,
];

ModalAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $idOrder], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $idOrder], [
            'class' => 'btn btn-danger',
            'data-toggle' => 'modal',
            'data-target' => '#mdConfirm',
            'data-url' => BaseUrl::toRoute(['delete', 'id' => $idOrder]),
            'data-message' => "Deseja deletar o pedido?"
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'attribute' => 'id',
              'value' => function ($model) {
                return $model[0]->idOrder;
              }
            ],
            [
              'attribute' => 'Data do Pedido',
              'value' => function ($model) use ($formater) {
                return $formater->asDate($model[0]->order->date);
              }
            ],
            [
              'attribute' => 'Total',
              'value' => function ($model) use ($formater) {
                $total = 0;
                foreach ($model as $model) {
                  $total+= $model->product->price;
                }
                return $formater->asCurrency($total);
              }
            ],
            [
              'attribute' => 'Produtos',
              'value' => function ($model) use ($formater) {
                foreach ($model as $model) {
                  $proproductList[] = $model->product->name;
                }

                return Html::ul($proproductList);
              },
              'format' => 'html'
            ]
        ],
    ]) ?>

    <?php Modal::begin($modalConfig) ?>
    <?php Modal::end() ?>
</div>
