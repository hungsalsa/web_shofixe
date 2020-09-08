<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\SanphamThongkeSearch */
/* @var $form yii\widgets\ActiveForm */
// if (count($search['cuahang']) == 1) {
//     $searchModel->cuahang_id = $search['cuahang'][0];
// }
?>

<div class="sanpham-thongke-search">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($searchModel, 'cuahang_id',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $search['cuahang'],
        'options' => ['placeholder' => 'Chọn 1 hành động','multiple'=>true],
        'pluginOptions' => [
            'autoclose'=>true,
            'allowClear' => true
        ]
    ]);?>

    <?= $form->field($searchModel, 'cate_id',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $search['category'],
        'options' => ['placeholder' => 'Chọn 1 hành động','multiple'=>true],
        'pluginOptions' => [
            'autoclose'=>true,
            'allowClear' => true
        ]
    ]);?>

    <?= $form->field($searchModel, 'proId',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataProduct,
        'options' => ['placeholder' => 'Chọn 1 hành động','multiple'=>true],
        'pluginOptions' => [
            'autoclose'=>true,
            'allowClear' => true
        ]
    ]);?>


   

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn_active']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default btn_active']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

