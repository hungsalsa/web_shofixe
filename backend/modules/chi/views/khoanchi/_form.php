<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChiKhoanchi */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="chi-khoanchi-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true,'enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'makhoanchi',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, "loaichi_id",['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataLoaichi,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
	<div class="clearfix"></div>
	<?= $form->field($model, 'donvitinh',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
	[
		'data' => $dataDonvitinh,
		'options' => ['placeholder' => 'Chon một'],
		'pluginOptions' => [
			'allowClear' => true,
		],
	]) 
	?>

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
