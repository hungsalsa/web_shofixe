<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\DungcuThietbi */

$this->title = 'Thêm mới dụng cụ - thiết bị';
$this->params['breadcrumbs'][] = ['label' => 'Dungcu Thietbis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dungcu-thietbi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataDonvitinh' => $dataDonvitinh,
    ]) ?>

</div>
