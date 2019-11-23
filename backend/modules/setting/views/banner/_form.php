<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
      [
          'initInputType' => CheckboxX::INPUT_CHECKBOX,
          'options'=>['value' => $model->status],
      ])->label(false);
      ?>
      <div class="clearfix"></div>
    <?= $form->field($model, 'content')->textarea(['rows' => 8,'class'=>'content']) ?>
    <?= $form->field($model, 'content_mobile')->textarea(['rows' => 8,'class'=>'content']) ?>


    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$this->registerJsFile("@web/tinymce/tinymce.min.js",['depends' => [\yii\web\JqueryAsset::className() ] ]);
$this->registerJsFile("@web/js/main.js",['depends' => [\yii\web\JqueryAsset::className() ] ]);
 ?>