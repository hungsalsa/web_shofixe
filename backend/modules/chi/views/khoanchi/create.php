<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChiKhoanchi */

$this->title = 'Thêm mới khoản chi';
$this->params['breadcrumbs'][] = ['label' => 'Chi Khoanchis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chi-khoanchi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataLoaichi' => $dataLoaichi,
        'dataDonvitinh' => $dataDonvitinh,
    ]) ?>

</div>
