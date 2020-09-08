<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form ActiveForm */
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password_hash')->passwordInput() ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'fullname') ?>
        <?= $form->field($model, 'cuahang_id') ?>

        <?php echo $form->field($model, 'view_cuahang')->radioList([0 =>'Không', 1 => 'Là người xem']); ?>
        <?php echo $form->field($model, 'manager')->radioList([0 =>'Không', 1 => 'Là người xem'])->label('Chọn quyền'); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
