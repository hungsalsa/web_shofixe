<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhDichvu */

$this->title = 'Chỉnh sửa dịch vụ / '.$model->khachhang->name.' /xe : '.$model->xesua->bks;;
$this->params['breadcrumbs'][] = ['label' => 'Kh Dichvus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddv, 'url' => ['view', 'id' => $model->iddv]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kh-dichvu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
    // <?= $this->render('_form_update', [
        'model' => $model,
        // 'chitiet' => $chitiet,
        'dataCuahang' => $dataCuahang,
        'dataKhachhang' => $dataKhachhang,
        'dataXeKH' => $dataXeKH,
        'dataEmployee' => $dataEmployee,
        'adddv' => $adddv,
        'datasophieu' => $datasophieu,
        'modelsKhChitietDv' => $modelsKhChitietDv,
    ]) ?>

</div>
