<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger text-center">
        <?= Html::tag('div', $message) ?>
        <?php // nl2br(Html::encode($message)) ?>
        <br>
        <?= Html::a('Trở lại trang trước', Yii::$app->request->referrer ?: Yii::$app->homeUrl, ['class' => 'btn btn-success button_luu']) ?>
    </div>

    <p>
        <!-- The above error occurred while the Web server was processing your request. -->
    </p>
    <p>
        <!-- Please contact us if you think this is a server error. Thank you. -->
    </p>

</div>
