<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container-fluid no-left-padding no-right-padding">
	<!-- Container -->
	<div class="container">
		<div class="row" style="margin-top: 30px">
<div class="site-error">


	<div class=" text-center">
	    <h1><?= nl2br(Html::encode($message)) ?> !</h1>
		<div class="image">
			<img src="<?= Yii::$app->request->hostinfo ?>/uploads/bg_error.jpg">
		</div>
	</div>

</div>
</div>
</div>
</div>