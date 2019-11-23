<?php
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1 class="text-center"><?= Html::encode('Xin lỗi bạn !') ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>



</div>
