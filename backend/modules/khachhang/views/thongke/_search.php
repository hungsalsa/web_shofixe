<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
// use kartikorm\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChingaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chingay-search col-md-10 col-md-offset-1">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'action' => ['index'],
        // 'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= $form->field($model, 'khachhang',['options'=>['class'=>'col-md-8']])->widget(Select2::classname(), [
        'data' => $dataKhachhang,
        'options' => ['placeholder' => 'Enter customer information ...'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>



    <div class="form-group" style="padding-top: 25px;">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary button_luu','style'=>'padding: 3px 10px;']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success button_luu','style'=>'padding: 3px 10px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
