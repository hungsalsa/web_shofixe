<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSudung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-sudung-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?php echo $form->field($model, 'ngay_sd')->hiddenInput(['value'=> $model->ngay_sd])->label(false);?>

    <?= $form->field($model, 'ngay_sd',['options' => ['class' => 'col-md-3']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ])->textInput(['value' => $model->ngay_sd,'disabled' => true]);?>

    <?= $form->field($model, "so_phieu_dau",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $sophieu,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "so_phieu_cuoi",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $sophieu,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


    <?= $form->field($model, 'sl_phieu_tot',['options' => ['class' => 'col-md-3']])->textInput() ?>

    <?= $form->field($model, 'phieu_huy',['options' => ['class' => 'col-md-7']])->widget(Select2::classname(), [
    	'data' => $sophieu,
    	'language' => 'vi',
    	'options' => ['placeholder' => 'Select many bill ...', 'multiple' => true],
    	'pluginOptions' => [
    		'tags' => true,
    		'tokenSeparators' => [',', ' '],
    		'maximumInputLength' => 10,
    		'allowClear' => true
    	],
    ]);?>

    


    <?= $form->field($model, "ke_toan",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
	<?= $form->field($model, 'status',['options' => ['class' => 'status_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
	<div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
