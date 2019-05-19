<?php

use app\assets\modal\ModalAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\Button;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produtos';
$this->params['breadcrumbs'][] = $this->title;

$modalFooter = Html::a('Não', '#', ['class'=> 'btn btn-secondary', 'data-dismiss'=>'modal']);
$modalFooter.= Html::a('Sim', '#', ['id' => 'btn-delete', 'class'=>'btn btn-danger']);

ModalAsset::register($this);
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Novo <span class="glyphicon glyphicon-plus"></span>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
              'attribute' => 'name',
              'format' => 'text',
              'value' => function ($model) {
                return strtoupper($model->name);
              }
            ],
            'sku',
            'price:currency',
            [
              'class' => 'yii\grid\ActionColumn',
              'contentOptions' => [
                'class'=> 'text-center'
              ],
              'buttons' => [
                'update' => function ($url, $model, $key) {
                  $icon = '<i class="fas fa-edit"></i>';
                  $config = [
                    'title' => 'Editar',
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
                    'data-message' => "Deseja excluir o produto \"{$model->name}\""
                  ];
                  return Html::a($icon, '#', $config);
                },
              ],
            ],
        ],
    ]); ?>

    <?php Modal::begin([
      'title' => 'Deletar Produto',
      'options' => ['id' => 'mdConfirm'],
      'footer' => $modalFooter
    ]) ?>
    <?php Modal::end() ?>
</div>
