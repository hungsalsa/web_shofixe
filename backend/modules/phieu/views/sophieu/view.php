<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSophieu */

$this->title = 'Chi tiết phiếu số : '.$model->so_phieu;
$this->params['breadcrumbs'][] = ['label' => 'Phieu Sophieus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-sophieu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Hãy kiểm tra đầy đủ thông tin trước khi xóa?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ngay_giao',
            'cuahang_id',
            'ngay_sd',
            'ngay_tt',
            'so_phieu',
            'status',
        ],
    ]) ?>

</div>
