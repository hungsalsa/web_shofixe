<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSophieu */

$this->title = 'Sửa thông tin phiếu : '.$model->so_phieu;
$this->params['breadcrumbs'][] = ['label' => 'Phieu Sophieus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phieu-sophieu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
