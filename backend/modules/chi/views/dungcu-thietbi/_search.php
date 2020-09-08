<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\DungcuThietbiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dungcu-thietbi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'madungcu') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'donvitinh') ?>

    <?= $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'tongnhap') ?>

    <?php // echo $form->field($model, 'tongxuat') ?>

    <?php // echo $form->field($model, 'toncuoi') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_add') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
