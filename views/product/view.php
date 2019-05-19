<?php

use app\assets\modal\ModalAsset;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\widgets\DetailView;
use yii\helpers\BaseUrl;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = ucwords($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', '#', [
            'class' => 'btn btn-danger',
            'data-toggle' => 'modal',
            'data-target' => '#mdConfirm',
            'data-url' => BaseUrl::toRoute(['delete', 'id' => $model->id]),
            'data-message' => "Deseja excluir o produto \"{$model->name}\""
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'attribute' => 'name',
              'value' => function($model) {
                return ucwords($model->name);
              }
            ],
            'description:html',
            'price:currency',
            'sku',
        ],
    ]) ?>

    <?php Modal::begin($modalConfig) ?>
    <?php Modal::end() ?>

</div>
