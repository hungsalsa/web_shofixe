<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingCategoryHome */
/* @var $form yii\widgets\ActiveForm */
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Loại sản phẩm : " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Loại sản phẩm : " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="setting-category-home-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true,'id' => 'dynamic-form']); ?>

    <div class="row">

    <?= $form->field($model, 'category_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
      'data' => $dataCate,
      'options' => ['placeholder' => 'Select a color ...'],
      'pluginOptions' => [
          'allowClear' => true,
          'tokenSeparators' => [',', ' '],
          'maximumInputLength' => 10
      ],
  ]) ?>

    <?= $form->field($model, 'location',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
      'data' => $dataLocation,
      'options' => ['placeholder' => 'Select a color ...'],
      'pluginOptions' => [
          'allowClear' => true,
          'tokenSeparators' => [',', ' '],
          'maximumInputLength' => 10
      ],
  ]) ?>


    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
      [
          'initInputType' => CheckboxX::INPUT_CHECKBOX,
          'options'=>['value' => $model->status],
      ])->label(false);
      ?>

      </div>

      <div class="row">
        <div class="panel panel-default col-md-6">
          <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Hiển thị loại sản phẩm </h4></div>
          <div class="panel-body">
           <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsProductType[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                  'product_type_id',
                  'name',
                ],
              ]); ?>

              <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsProductType as $i => $modelProductType): ?>
                  <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                      <!-- <h3 class="panel-title pull-left">Loại sản phẩm</h3> -->
                      <span class="panel-title-address">Loại sản phẩm : <?= ($i + 1) ?></span>
                      <div class="pull-right">
                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                      <?php
                            // necessary for update action.
                      if (! $modelProductType->isNewRecord) {
                        echo Html::activeHiddenInput($modelProductType, "[{$i}]id");
                      }
                      ?>
                      <div class="row">
                        <div class="col-sm-3">
                          <?= $form->field($modelProductType, "[{$i}]product_type_id")->widget(Select2::classname(), [
                                            'data' => $dataProductType,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Chọn loại sản phẩm hiển thị'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                ?>
                        </div>
                        <div class="col-sm-9">
                          <?= $form->field($modelProductType, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                        </div>
                      </div><!-- .row -->
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <?php DynamicFormWidget::end(); ?>
            </div>
          </div>
        </div>

      <div class="form-group button_save" style="margin-top: 62px;margin-right: 90px">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-default px-5']) ?>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>
