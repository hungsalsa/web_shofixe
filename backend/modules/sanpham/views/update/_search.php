<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
// use kartikorm\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChingaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chingay-search">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'status',['options'=>['class'=>'col-md-2 ml-5']])->checkbox(['class'=>' display-3']) ?>

    <div class="form-group">
        <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-primary button_luu','style'=>'padding: 3px 10px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
