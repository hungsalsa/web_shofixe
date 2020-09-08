<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhXeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kh-xe-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_KH') ?>

    <?= $form->field($model, 'xe') ?>

    <?= $form->field($model, 'bks') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'nguoi_sd') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
