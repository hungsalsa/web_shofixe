<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuGiao */

$this->title = 'Thêm mới phiếu giao';
$this->params['breadcrumbs'][] = ['label' => 'Phiếu giao', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-giao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataEmployee' => $dataEmployee,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
