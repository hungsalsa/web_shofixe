<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhThu */

$this->title = 'Create Doanh Thu';
$this->params['breadcrumbs'][] = ['label' => 'Doanh Thus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanh-thu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCuahang' => $dataCuahang,
        'dataEmployee' => $dataEmployee,
    ]) ?>

</div>
