<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\DungcuThietbi */

$this->title = 'Chỉnh sửa dụng cụ - thiết bị: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dungcu Thietbis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dungcu-thietbi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataDonvitinh' => $dataDonvitinh,
    ]) ?>

</div>
