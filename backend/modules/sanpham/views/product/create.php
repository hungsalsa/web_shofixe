<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Product */

$this->title = 'Thêm mới sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

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
