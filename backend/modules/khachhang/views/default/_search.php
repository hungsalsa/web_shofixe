<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

// if ($_POST)
// {
//     $model->khachhang = $_POST['InhdSearch']['khachhang'];
//     $model->ngay_in = $_POST['InhdSearch']['xe_kh'];
// }
?>

<div class="chingay-search col-md-12">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
    ]); ?>


    <?= $form->field($model, 'khachhang',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
        'data' => $dataKhachhang,
        'options' => ['placeholder' => 'Enter customer information ...','id'=>'cat-id'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'xe_kh',['options'=>['class'=>'col-md-3']])->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat-id'],
        'pluginOptions'=>[
            'allowClear' => true,
            'depends'=>['cat-id'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/khachhang/default/subcat'])
        ]
    ]); ?>

    <?= $form->field($model, 'ngay_in',['options'=>['class'=>'col-md-3']])->widget(DepDrop::classname(), [
        'pluginOptions'=>[
            'depends'=>['cat-id', 'subcat-id'],
            'placeholder'=>'Select...',
            'format' => 'dd-mm-yyyy',
            'url'=>Url::to(['/khachhang/default/prod'])
        ]
    ]);
    ?>


    <div class="clearfix"></div>
    <div class="form-group" style="padding-top: 25px;">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary button_luu','style'=>'padding: 3px 10px;']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success button_luu','style'=>'padding: 3px 10px;']) ?>
        <?= Html::a('Thêm Khách hàng', ['/khachhang/khachhang/create'], ['class' => 'btn btn-info button_luu','style'=>'padding: 3px 10px;']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
