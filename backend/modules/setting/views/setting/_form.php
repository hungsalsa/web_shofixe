<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 195x243 pixel']) ?>
    <div class="col-md-3" style="height: 80px">
        <img src="<?= (isset($model->logo))? Yii::$app->request->hostInfo.'/'.$model->logo:''?>" id="previewImage" alt="" style="height: 100%;max-width: 100%">
    </div>

    <?= $form->field($model, 'google_analytics',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'footer')->textarea(['rows' => 6,'class'=>'content']) ?>


    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
