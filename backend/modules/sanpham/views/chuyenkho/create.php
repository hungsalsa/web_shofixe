<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductTransfer */

$this->title = 'Tạo phiếu chuyển kho';
$this->params['breadcrumbs'][] = ['label' => 'Product Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-transfer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataStatus' => $dataStatus,
        'dataCuahang' => $dataCuahang,
        'dataChuyen' => $dataChuyen,
        'dataEmployee' => $dataEmployee,
        // 'dataProduct' => $dataProduct,
        'modelsProductTransferDetail' => $modelsProductTransferDetail,
    ]) ?>

</div>
