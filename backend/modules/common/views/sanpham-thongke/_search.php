<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\SanphamThongkeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sanpham-thongke-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'masp') ?>

    <?= $form->field($model, 'cuahang_id') ?>

    <?= $form->field($model, 'proName') ?>

    <?= $form->field($model, 'sldauky') ?>

    <?php // echo $form->field($model, 'tiendauky') ?>

    <?php // echo $form->field($model, 'slnhap') ?>

    <?php // echo $form->field($model, 'tiennhap') ?>

    <?php // echo $form->field($model, 'slxuat') ?>

    <?php // echo $form->field($model, 'tienxuat') ?>

    <?php // echo $form->field($model, 'slxuatnb') ?>

    <?php // echo $form->field($model, 'slnhapnb') ?>

    <?php // echo $form->field($model, 'slton') ?>

    <?php // echo $form->field($model, 'tienton') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
