<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChiLoaichi */
/* @var $form yii\widgets\ActiveForm */
$disable = false;
$control = Yii::$app->controller->action->id;
if ($control == 'update' && $model->id==1) {
    $disable = true;
}
?>

<div class="chi-loaichi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'disabled' => $disable]) ?>

    <?= $form->field($model, 'status',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
    	[
    		'data' => [0 =>'Ẩn',1=>'Kích hoạt'],
    		'options' => ['placeholder' => 'Chon một'],
    		'pluginOptions' => [
    			'allowClear' => true,
    		],
    	]) 
    	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Chỉnh sửa', ['class' => 'btn btn-success btn_active']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
