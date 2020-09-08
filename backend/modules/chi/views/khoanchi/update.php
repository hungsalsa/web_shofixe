<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChiKhoanchi */

$this->title = 'Chỉnh sửa khoản chi: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chi Khoanchis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chi-khoanchi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataLoaichi' => $dataLoaichi,
        'dataDonvitinh' => $dataDonvitinh,
    ]) ?>

</div>
