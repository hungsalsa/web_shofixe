<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\SanphamThongke */

$this->title = 'Create Sanpham Thongke';
$this->params['breadcrumbs'][] = ['label' => 'Sanpham Thongkes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sanpham-thongke-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
