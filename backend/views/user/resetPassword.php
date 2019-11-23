<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Reset password tài khoản : '.$user_username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>
<p></p>
    <p>Nhập mật khẩu 2 ô giống nhau cho tài khoản :</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'newPasswordConfirm')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton(' Save ', ['class' => 'btn btn-danger']) ?>
                    <?= Html::a(' Cancel ', ['index'], ['class' => 'btn btn-success']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>