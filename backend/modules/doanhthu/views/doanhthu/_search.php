<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhThuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doanh-thu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ngay') ?>

    <?= $form->field($model, 'tt_ck') ?>

    <?= $form->field($model, 'tt_the') ?>

    <?= $form->field($model, 'tt_tien_mat') ?>

    <?php // echo $form->field($model, 'tien_chi') ?>

    <?php // echo $form->field($model, 'tien_hom') ?>

    <?php // echo $form->field($model, 'tien_le') ?>

    <?php // echo $form->field($model, 'chenh_lech') ?>

    <?php // echo $form->field($model, 'ketoan') ?>

    <?php // echo $form->field($model, 'nguoi_ky') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'cua_hang') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_add') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
