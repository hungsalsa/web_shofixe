<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\BanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ban-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'id_tua') ?>

    <?= $form->field($model, 'birthday') ?>

    <?= $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'relationship') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'price_sales') ?>

    <?php // echo $form->field($model, 'loinhuan') ?>

    <?php // echo $form->field($model, 'gianet') ?>

    <?php // echo $form->field($model, 'giaban') ?>

    <?php // echo $form->field($model, 'datcoc') ?>

    <?php // echo $form->field($model, 'thanhtoan') ?>

    <?php // echo $form->field($model, 'ngayphaitt') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'users_add') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
