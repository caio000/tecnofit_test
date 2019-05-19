<?php

use app\assets\modal\ModalAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;

$modalFooter = Html::a('Não', '#', ['class'=> 'btn btn-secondary', 'data-dismiss'=>'modal']);
$modalFooter.= Html::a('Sim', '#', ['id' => 'btn-delete', 'class'=>'btn btn-danger']);

ModalAsset::register($this);
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Pedido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date:date',

            [
              'class' => 'yii\grid\ActionColumn',
              'contentOptions' => [
                'class' => 'text-center'
              ],
              'buttons' => [
                'update' => function ($url, $model, $key) {
                  $icon = '<i class="fas fa-edit"></i>';
                  $config = [
                    'title' => 'Editar'
                  ];
                  return Html::a($icon, $url, $config);
                },
                'view' => function ($url, $model, $key) {
                  $icon = '<i class="fas fa-eye"></i>';
                  $config = [
                    'title' => 'Visualizar'
                  ];
                  return Html::a($icon, $url, $config);
                },
                'delete' => function ($url, $model, $key) {
                  $icon = '<i class="fas fa-trash-alt"></i>';
                  $config = [
                    'title' => 'Excluir',
                    'data-toggle' => 'modal',
                    'data-target' => '#mdConfirm',
                    'data-url' => $url,
                    'data-message' => "Deseja deletar o pedido?"
                  ];
                  return Html::a($icon, '#', $config);
                },
              ]
            ],
        ],
    ]); ?>

    <?php Modal::begin([
      'title' => 'Deletar Pedido',
      'options' => ['id' => 'mdConfirm'],
      'footer' => $modalFooter
    ]) ?>
    <?php Modal::end() ?>
</div>
