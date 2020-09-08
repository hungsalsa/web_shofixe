<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\VattuThSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vattu-th-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'machi') ?>

    <?= $form->field($model, 'dvt') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'sl_dk') ?>

    <?php // echo $form->field($model, 'sl_nhap') ?>

    <?php // echo $form->field($model, 'sl_xuat') ?>

    <?php // echo $form->field($model, 'sl_ton') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_add') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
