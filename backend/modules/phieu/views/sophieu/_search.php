<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSophieuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-sophieu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ngay_giao') ?>

    <?= $form->field($model, 'cuahang_id') ?>

    <?= $form->field($model, 'ngay_sd') ?>

    <?= $form->field($model, 'ngay_tt') ?>

    <?php // echo $form->field($model, 'so_phieu') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
