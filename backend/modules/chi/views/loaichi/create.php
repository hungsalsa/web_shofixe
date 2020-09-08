<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChiLoaichi */

$this->title = 'Thêm mới loại chi';
$this->params['breadcrumbs'][] = ['label' => 'Chi Loaichis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chi-loaichi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
