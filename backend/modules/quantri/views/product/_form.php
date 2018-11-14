<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use jlorente\remainingcharacters\RemainingCharacters;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Product */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/plugins/bower_components/sweetalert/sweetalert.css');
?>

<div class="product-form">
   <?php $form = ActiveForm::begin(['enableAjaxValidation' => true,'id' => 'dynamic-form']); ?>
   <div class="form-group button_save">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
      <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-default px-5']) ?>
   </div>
   <svg class="hidden">
      <defs>
         <path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z" />
      </defs>
   </svg>
   <section class="m-t-40">
      <div class="sttabs tabs-style-shape">
         <nav>
            <ul>
               <li>
                  <a href="#section-shape-1">
                     <svg viewBox="0 0 80 60" preserveAspectRatio="none">
                        <use xlink:href="#tabshape"></use>
                     </svg>
                     <span>Thông tin chung</span> 
                  </a>
               </li>
               <li>
                  <a href="#section-shape-2">
                     <svg viewBox="0 0 80 60" preserveAspectRatio="none">
                        <use xlink:href="#tabshape"></use>
                     </svg>
                     <svg viewBox="0 0 80 60" preserveAspectRatio="none">
                        <use xlink:href="#tabshape"></use>
                     </svg>
                     <span>Liên kết </span> 
                  </a>
               </li>
               <li>
                  <a href="#section-shape-3">
                     <svg viewBox="0 0 80 60" preserveAspectRatio="none">
                        <use xlink:href="#tabshape"></use>
                     </svg>
                     <svg viewBox="0 0 80 60" preserveAspectRatio="none">
                        <use xlink:href="#tabshape"></use>
                     </svg>
                     <span>SEO</span> 
                  </a>
               </li>
               <li>
                  <a href="#section-shape-4">
                     <svg viewBox="0 0 80 60" preserveAspectRatio="none">
                        <use xlink:href="#tabshape"></use>
                     </svg>
                     <svg viewBox="0 0 80 60" preserveAspectRatio="none">
                        <use xlink:href="#tabshape"></use>
                     </svg>
                     <span>Danh sách Ảnh</span> 
                  </a>
               </li>
            </ul>
         </nav>
         <div class="content-wrap">
            <section id="section-shape-1">
               <?= $form->field($model, 'pro_name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>


               <?= 
               $form->field($model, 'image',['options'=>['class'=>'col-md-2']]) ->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 220x270 pixel','data-toggle'=>'modal','data-target'=>'#myModal']) ?>


               <div class="col-md-1" style="height: 80px">
                  <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 100%">
               </div>
               
               <?= $form->field($model, 'code',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true]) ?>
               <?= $form->field($model, 'price',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
                  'maskedInputOptions' => [
                              // 'prefix' => 'vnđ ',
                      'suffix' => '',
                      'allowMinus' => false,
                      'groupSeparator' => '.',
                      'radixPoint' => ','
                  ],
                  'displayOptions' => ['class' => 'form-control kv-monospace'],
                  'saveInputContainer' => ['class' => 'kv-saved-cont']
                  ]);
                  ?>
                  <div class="clearfix"></div>
               <?= $form->field($model, 'price_sales',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
                  'maskedInputOptions' => [
                              // 'prefix' => 'vnđ ',
                      'suffix' => '',
                      'allowMinus' => false,
                      'groupSeparator' => '.',
                      'radixPoint' => ','
                  ],
                  'displayOptions' => ['class' => 'form-control kv-monospace'],
                  'saveInputContainer' => ['class' => 'kv-saved-cont']
                  ]);
                  ?>
                  
               <?= $form->field($model, 'start_sale',['options'=>['class'=>'col-md-2']])->textInput() ?>

               <?= $form->field($model, 'end_sale',['options'=>['class'=>'col-md-2']])->textInput() ?>

               <?= $form->field($model, 'guarantee',['options'=>['class'=>'col-md-1']])->textInput(['type'=>'number']) ?>

               <?= $form->field($model, 'order',['options'=>['class'=>'col-md-1']])->textInput(['type'=>'number']) ?>

               <?= $form->field($model, 'active',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
                  [
                      'initInputType' => CheckboxX::INPUT_CHECKBOX,
                      'options'=>['value' => $model->active],
                  ])->label(false);
                  ?>
               <div class="clearfix"></div>
               <?php 
               echo $form->field($model, 'short_introduction')->widget(RemainingCharacters::classname(), [
                'type' => RemainingCharacters::INPUT_TEXTAREA,
                'text' => Yii::t('app', '{n} ký tự còn lại'),
                'label' => [
                  'tag' => 'p',
                  'id' => 'my-counter',
                  'class' => 'counter',
                  'invalidClass' => 'error'
                ],
                'options' => [
                  'rows' => '3',
                  'class' => 'col-md-12',
                  'maxlength' => 165,
                  'placeholder' => Yii::t('app', 'Giới thiệu ngắn sản phẩm, dài nhất 165 ký tự')
                ]
              ]);

              ?>

               <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'content']) ?>
            </section>
            <section id="section-shape-2">
               <?= $form->field($model, 'product_category_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataCate,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                      'allowClear' => true,
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>

               <?= $form->field($model, 'manufacturer_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataManu,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                      'allowClear' => true,
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>

               <?= $form->field($model, 'models_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataModels,
                  'options' => ['placeholder' => 'Select a color ...','multiple'=>true],
                  'pluginOptions' => [
                      'allowClear' => true,
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'product_type_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataProtype,
                  'options' => ['placeholder' => 'Select a color ...','multiple'=>true],
                  'pluginOptions' => [
                      'allowClear' => true,
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'related_articles',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataNews,
                  'options' => ['placeholder' => 'Select a color ...','multiple'=>true],
                  'pluginOptions' => [
                      'allowClear' => true,
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'related_products',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataProduct,
                  'options' => ['placeholder' => 'Select a color ...','multiple'=>true],
                  'pluginOptions' => [
                      'allowClear' => true,
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'tags',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  // 'data' => $dataCate,
                  'options' => ['placeholder' => 'Select a color ...','multiple'=>true],
                  'pluginOptions' => [
                    'tags' => true,
                    'allowClear' => true,
                    'tokenSeparators' => [','],
                    'maximumInputLength' => 10
                  ],
                  ]) ?>
            </section>
            <section id="section-shape-3">
               <?= $form->field($model, 'title',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true,'id'=>'title_slug'])?>
               <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>
               <?= $form->field($model, 'keyword')->textarea(['rows' => 6]) ?>
               <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </section>

            <section id="section-shape-4">
             <div class="row">
              <div class="panel panel-default col-md-12">
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
                'model' => $modelsImgproList[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                  'image',
                  'title',
                  'alt',
                  'status',
                ],
              ]); ?>

              <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsImgproList as $i => $modelImgproList): ?>
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
                      if (! $modelImgproList->isNewRecord) {
                        echo Html::activeHiddenInput($modelImgproList, "[{$i}]id");
                      }
                      ?>
                      <div class="row">
                        <div class="col-sm-12">
                          <?= $form->field($modelImgproList, "[{$i}]image",['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true]) ?>

                          <div class="col-md-2" style="height: 80px">
                            <img src="<?= (isset($modelImgproList->image))? Yii::$app->request->hostInfo.'/'.$modelImgproList->image:''?>" id="previewItems" alt="" style="height: 100%">
                          </div>

                          <?= $form->field($modelImgproList, "[{$i}]title",['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true]) ?>
                          <?= $form->field($modelImgproList, "[{$i}]alt",['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true]) ?>
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
      </section>
         </div>
         <!-- /content -->
      </div>
      <!-- /tabs -->
   </section>
   <!-- Tabstyle start -->
   <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJsFile('@web/js/cbpFWTabs.js');
// $this->registerJsFile('@web/js/jquery.ui.datepicker-vi-VN.js');
// $this->registerJsFile('@web/plugins/bower_components/sweetalert/sweetalert.min.js');
// $this->registerJsFile('@web/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js');

$script = <<< JS
(function () {
    [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
        new CBPFWTabs(el);
        });
        })();
JS;
$this->registerJs($script);
?>