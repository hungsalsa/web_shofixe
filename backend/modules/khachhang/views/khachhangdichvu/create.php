<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhDichvu */

$this->title = 'Dịch vụ: '.$dataKhachhang[$model->id_kh];
$this->params['breadcrumbs'][] = ['label' => 'Kh Dichvus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kh-dichvu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'adddv' => $adddv,
        'dataCuahang' => $dataCuahang,
        'dataKhachhang' => $dataKhachhang,
        'dataXeKH' => $dataXeKH,
        'dataEmployee' => $dataEmployee,
        // 'dataDichvu' => $dataDichvu,
        'datasophieu' => $datasophieu,
        // 'modelsKhChitietDv' => $modelsKhChitietDv,
    ]) ?>

</div>
