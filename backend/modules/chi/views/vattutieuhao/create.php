<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\VattuTh */

$this->title = 'Create Vattu Th';
$this->params['breadcrumbs'][] = ['label' => 'Vattu Ths', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vattu-th-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataDonvitinh' => $dataDonvitinh,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
