<?php
// session_start();
use yii\helpers\Html;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\web\Session;

?>
<br>
<div class="user-form">
	<?= Alert::widget() ?>

		<?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

		<?= $form->field($user, 'currentPassword',['options'=>['class'=>'col-md-4']])->passwordInput()->label('Mật khẩu cũ') ?>

		<?= $form->field($user, 'newPassword',['options'=>['class'=>'col-md-4']])->passwordInput()->label('Mật khẩu mới') ?>

		<?= $form->field($user, 'newPasswordConfirm',['options'=>['class'=>'col-md-4']])->passwordInput()->label('Nhập lại mật khẩu mới') ?>

		<div class="form-group">
	        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
	    </div>

	<?php ActiveForm::end(); ?>
</div>
<?php $this->registerJsFile("@web/plugins/bower_components/jquery/dist/jquery.min.js"); ?>