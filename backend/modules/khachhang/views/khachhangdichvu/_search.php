<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhDichvuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kh-dichvu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'iddv') ?>

    <?= $form->field($model, 'day') ?>

    <?= $form->field($model, 'cuahang_id') ?>

    <?= $form->field($model, 'id_kh') ?>

    <?= $form->field($model, 'id_xe') ?>

    <?php // echo $form->field($model, 'total_money') ?>

    <?php // echo $form->field($model, 'id_nhanvien') ?>

    <?php // echo $form->field($model, 'id_ketoan') ?>

    <?php // echo $form->field($model, 'id_quanly') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_add') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
