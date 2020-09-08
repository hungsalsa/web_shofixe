<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chingay */

$this->title = 'Chỉnh sửa khoản chi : '.$model->cuahang->name;
$this->params['breadcrumbs'][] = ['label' => 'Chingays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chingay-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
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
