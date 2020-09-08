<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Product */

$this->title = 'Chỉnh sửa sản phẩm: '.$model->proName;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataUnit' => $dataUnit,
        'dataMotor' => $dataMotor,
        'dataManu' => $dataManu,
        'dataCate' => $dataCate,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
