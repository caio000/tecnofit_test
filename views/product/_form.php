<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\money\MaskMoney;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-row">
      <?= $form->field($model, 'name', ['options' => ['class' => 'form-group col-xs-12 col-md-5']])->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'sku', ['options' => ['class' => 'form-group col-xs-12 col-md-5']])->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'price', ['options' => ['class' => 'form-group col-xs-12 col-md-2']])->widget(MaskMoney::classname(), [
        'pluginOptions' => [
          'prefix' => 'R$ ',
          'thousands' => '.',
          'decimal' => ',',
        ]
      ])?>

      <?= $form->field($model, 'description', ['options' => ['class' => 'form-group col-xs-12 col-md-12']])->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
      ])?>

      <div class="form-group col-xs-12 col-md-2">
        <?= Html::submitButton('Salvar <i class="fas fa-save"></i>', ['class' => 'btn btn-success btn-block']) ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
