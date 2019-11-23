<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\ProductCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <div class="form-group button_save">
      <?= Html::submitButton('Save', ['class' => 'btn btn-success px-5']) ?>
      <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-default px-5']) ?>
   </div>
    <div class="clearfix"></div>
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
                           <span>Liên kết & SEO </span> 
                        </a>
                     </li>

                  </ul>
               </nav>
               <div class="content-wrap">
                  <section id="section-shape-1">
                     <?= $form->field($model, 'cateName',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>


                     <?= $form->field($model, 'image',['options'=>['class'=>'col-md-2']])
                     ->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 472x269 pixel','data-toggle'=>'modal','data-target'=>'#myModal']) 
                     ?>
                     <div class="col-md-1" style="height: 80px">
                        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 100%">
                    </div>


                    <?= $form->field($model, 'order',['options'=>['class'=>'col-md-1']])->textInput(['type'=>'number']) ?>

                    <?= $form->field($model, 'active',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
                        [
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['value' => $model->active],
                        ])->label(false);
                        ?>
                    <?= $form->field($model, 'home_page',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
                        [
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['value' => $model->home_page],
                        ])->label(false);
                        ?>
                    <div class="clearfix"></div>
                     <?= $form->field($model, 'short_introduction')->textarea(['rows' => 6,'class'=>'content']) ?>

                    <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'content']) ?>

                  </section>
                  <section id="section-shape-2">

                     <?= $form->field($model, 'group_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                        'data' => $dataGroup,
                        'options' => ['placeholder' => 'Select a color ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tokenSeparators' => [',', ' '],
                            'maximumInputLength' => 10
                        ],
                    ]) ?>

                     <?= $form->field($model, 'cate_parent_id',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                        'data' => $dataCate,
                        'options' => ['placeholder' => 'Select a color ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'tokenSeparators' => [',', ' '],
                            'maximumInputLength' => 10
                        ],
                    ]) ?>
                    <?= $form->field($model, 'title',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true,'id'=>'title_slug'])?>
                    
                    <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>

                    

                    <?= $form->field($model, 'keyword')->textarea(['rows' => 2]) ?>

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
$script = <<< JS
(function () {
    [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
        new CBPFWTabs(el);
        });
        })();
JS;
$this->registerJs($script);
?>