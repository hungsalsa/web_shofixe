<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Product */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/plugins/bower_components/sweetalert/sweetalert.css');
?>

<?php 
// echo '<br>'.$u = 'admin';
// echo '<br>'.$uth = 'pkHWEe0Vj6vdZ18rfE898DlmKH90kz1G';

// echo '<br>'. $user =  Yii::$app->user->identity->username;
// echo '<br>'.$auth_key =  Yii::$app->user->identity->auth_key;
// echo '<br>'.md5($user.$auth_key).'<br>';
// echo md5($u.$uth);
// die;
 ?>


<div class="product-form">
   <?php $form = ActiveForm::begin(); ?>
   <div class="form-group pull-right" style="padding-right: 50px">
      <?= Html::submitButton('Save', ['class' => 'btn btn-success px-5']) ?>
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
            </ul>
         </nav>
         <div class="content-wrap">
            <section id="section-shape-1">
               <?= $form->field($model, 'pro_name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>


               <?= 
               $form->field($model, 'image',['options'=>['class'=>'col-md-1']])
               ->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 195x243 pixel','data-toggle'=>'modal','data-target'=>'#myModal']) 
               ?>


               <div class="col-md-1" style="height: 80px">
                  <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 100%">
               </div>
               <?php // $form->field($model, 'images_list')->textInput(['maxlength' => true]) ?>
               <?php // $form->field($model, 'views')->textInput() ?>
               <?php // $form->field($model, 'salse')->textInput() ?>
               <?php // $form->field($model, 'hot')->textInput() ?>
               <?php // $form->field($model, 'best_seller')->textInput() ?>
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
                  <div class="clearfix"></div>
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
               <?= $form->field($model, 'short_introduction')->textarea(['rows' => 6]) ?>
               <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'content']) ?>
            </section>
            <section id="section-shape-2">
               <?= $form->field($model, 'product_category_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataCate,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'manufacturer_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataManu,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'models_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataModels,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'product_type_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataProtype,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'related_articles',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataNews,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'related_products',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  'data' => $dataProduct,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                      'tokenSeparators' => [',', ' '],
                      'maximumInputLength' => 10
                  ],
                  ]) ?>
               <?= $form->field($model, 'tags',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                  // 'data' => $dataCate,
                  'options' => ['placeholder' => 'Select a color ...'],
                  'pluginOptions' => [
                  'tokenSeparators' => [',', ' '],
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