<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Manufactures */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/plugins/bower_components/sweetalert/sweetalert.css');
?>
<div class="manufactures-form">

    <?php $form = ActiveForm::begin([
        'id' => 'contact-form',
        'enableAjaxValidation' => true,
        'validationUrl'=>Url::toRoute('manufactures/validation'),
    ]); ?>

    <div class="form-group button_save">
      <?= Html::submitButton('Save', ['class' => 'btn btn-success px-5']) ?>
      <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-default px-5']) ?>
   </div>
    <div class="clearfix"></div>
    <?= $form->field($model, 'ManName',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'title',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true,'id'=>'title_slug'])?>

    <?= $form->field($seo, 'slug',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>

    <?= $form->field($model, 'image',['options'=>['class'=>'col-md-4']])
    ->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 195x243 pixel','data-toggle'=>'modal','data-target'=>'#myModal']) 
    ?>


    <div class="col-md-2" style="height: 80px">
      <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 100%">
  </div>

  <?= $form->field($model, 'active',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
      [
          'initInputType' => CheckboxX::INPUT_CHECKBOX,
          'options'=>['value' => $model->active],
      ])->label(false);
      ?>

    <?= $form->field($model, 'order',['options'=>['class'=>'col-md-1']])->textInput(['type'=>'number']) ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'keyword')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 18,'class'=>'content']) ?>
    <?php // $form->field($model, 'parent_id')->textInput() ?>




    

    <?php ActiveForm::end(); ?>

</div>
