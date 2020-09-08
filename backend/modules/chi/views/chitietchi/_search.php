<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChitietchiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chitietchi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'money') ?>

    <?= $form->field($model, 'motorbike') ?>

    <?php // echo $form->field($model, 'bill_number') ?>

    <?php // echo $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'chingay_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
