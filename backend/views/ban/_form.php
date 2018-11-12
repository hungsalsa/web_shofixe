<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Ban */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ban-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tua')->textInput() ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'relationship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_sales')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loinhuan')->textInput() ?>

    <?= $form->field($model, 'gianet')->textInput() ?>

    <?= $form->field($model, 'giaban')->textInput() ?>

    <?= $form->field($model, 'datcoc')->textInput() ?>

    <?= $form->field($model, 'thanhtoan')->textInput() ?>

    <?= $form->field($model, 'ngayphaitt')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'users_add')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
