<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-row">
      <?= $form->field($model, 'products', ['options' => ['class' => 'form-group col-xs-12 col-md-12']])->widget(Select2::className(), [
        'data' => $products,
        'options' => [
          'placeholder' => 'Selecione os Produtos',
          'multiple' => 'multiple',
        ]
      ]) ?>

      <div class="form-group col-xs-12 col-md-2">
        <?= Html::submitButton('Salvar <i class="fas fa-save"></i>', ['class' => 'btn btn-success btn-block']) ?>
      </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
