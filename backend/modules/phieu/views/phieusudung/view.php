<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSudung */

$this->title = $model->ngay_sd.' / '.$model->cuahang_id;
$this->params['breadcrumbs'][] = ['label' => 'Phieu Sudungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-sudung-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc muốn xóa, bạn phải kiểm tra thật kỹ trước khi xóa?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cuahang_id',

            'ngay_sd',
            'so_phieu_dau',
            'so_phieu_cuoi',
            'phieu_ton',
            'phieu_ton_tt',
            'phieu_huy',
            'sl_phieu_tot',
            'ke_toan',
            'quan_ly',
            'note:ntext',
            'status',
            'created_at',
            'updated_at',
            'user_create',
        ],
    ]) ?>

</div>
