<?php
// session_start();
use yii\helpers\Html;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\web\Session;

?>

<div class="user-form">
	<?= Alert::widget() ?>

		<?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

		<?= $form->field($user, 'currentPassword')->passwordInput() ?>

		<?= $form->field($user, 'newPassword')->passwordInput() ?>

		<?= $form->field($user, 'newPasswordConfirm')->passwordInput() ?>

		<div class="form-group">
	        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
	    </div>

	<?php ActiveForm::end(); ?>
</div>