<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductTransfer */
$user = Yii::$app->user->identity;
if ($model->status == 1 && in_array($model->chuyenden_cuahang,json_decode($user->cuahang_id))) {
    $title_update = 'Danh sách hàng nhập từ cửa hàng: '.$model->cuahang->name;
}else {
    $title_update = 'Chỉnh sửa phiếu chuyển kho tới: '.$model->chuyenden->name;
}
$this->title = $title_update;
$this->params['breadcrumbs'][] = ['label' => 'Product Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_transfer, 'url' => ['view', 'id' => $model->id_transfer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-transfer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataStatus' => $dataStatus,
        'dataCuahang' => $dataCuahang,
        'dataChuyen' => $dataChuyen,
        'dataEmployee' => $dataEmployee,
        // 'dataProduct' => $dataProduct,
        // 'dataAllProduct' => $dataAllProduct,
        'modelsProductTransferDetail' => $modelsProductTransferDetail,
    ]) ?>

</div>
