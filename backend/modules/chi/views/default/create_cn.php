<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chingay */

$this->title = 'Thêm mới các khoản chi gia công - phụ tùng lẻ';
$this->params['breadcrumbs'][] = ['label' => 'Chingays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chingay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_cn', [
        'model' => $model,
        'dataCuahang' => $dataCuahang,
        'dataKhoanchi' => $dataKhoanchi,
        'dataMotor' => $dataMotor,
        'dataEmployee' => $dataEmployee,
        'dataSophieu' => $dataSophieu,
        'dataSupplier' => $dataSupplier,
        'modelsChitietchi' => $modelsChitietchi,
    ]) ?>

</div>
