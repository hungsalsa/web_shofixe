<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\SanphamThongkeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sanpham-thongke-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        // 'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'capnhat',['options' => ['class' => 'col-md-6']])->widget(Select2::classname(), [
                'data' => [1=>'Cập nhật',0=>'Ko cập nhật'],
                'options' => ['placeholder' => 'Chọn 1 hành động'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true
                ]
            ]);?>
   

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn_active']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default btn_active']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

