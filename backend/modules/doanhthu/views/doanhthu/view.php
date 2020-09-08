<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\doanhthu\models\CuaHang;
use backend\modules\chi\models\Employee;
/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhThu */

$this->title = 'Chi tiết doanh thu : '.$model->ngay ;
$this->params['breadcrumbs'][] = ['label' => 'Doanh Thus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanh-thu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'ngay',
                'format' => ['date', 'php: d-m-Y']
            ],
            [
                'attribute' => 'cua_hang',
                'contentOptions' => ['width' => '60%'],
                'value'=>function($data){
                     $cuahang = new CuaHang();
                    return $cuahang->getName($data->cua_hang);
                    // return CuaHang::getName($data->cua_hang);
                }
            ],
            [
                'attribute' =>'giao_sang',
                'contentOptions' => ['style' => 'color:#f00;font-size:18px'],
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tt_ck',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tt_the',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tt_tien_mat',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tong_doanh_thu_phieu',
                'format'=>['decimal',0],
                'contentOptions' => ['style' => 'color:#f00;font-size:18px'],
                'label'=>'Tổng thu phiếu  = Tiền phiếu + Tiền CK + Tiền TT thẻ'
            ],
            [
                'attribute' =>'thu_khac',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'doanh_thu_thuc',
                'format'=>['decimal',0],
                'label'=>'Doanh thu thực  = Tổng thu phiếu + thu khác + chênh lệch'
            ],
            [
                'attribute' =>'tien_chi',
                'contentOptions' => ['style' => 'color:#f00;font-size:18px'],
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tien_hom',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tien_le',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tong_tien_mat',
                'format'=>['decimal',0],
                'contentOptions' => ['style' => 'color:#f00;font-size:18px'],
                'label'=>'Tổng tiền mặt  = tiền lẻ + tiền hòm'
            ],
            [
                'attribute' =>'chenh_lech',
                'contentOptions' => ['style' => 'color:#f00;font-size:18px;font-weight: bold;'],
                'value'=>($model->chenh_lech >= 0)? '+'.Yii::$app->formatter->asDecimal($model->chenh_lech,0): Yii::$app->formatter->asDecimal($model->chenh_lech,0),
            ],
            [
                'attribute' => 'ketoan',
                'contentOptions' => ['width' => '60%'],
                'value'=>function($data){
                    $nv = new Employee();
                    return  $nv->getName($data->ketoan);
                }
            ],
            [
                'attribute' => 'nguoi_ky',
                'contentOptions' => ['width' => '60%'],
                'value'=>function($data){
                    $nv = new Employee();
                    return $nv->getName($data->nguoi_ky);
                }
            ],
            'note:ntext',
            'status',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            'user_add',
        ],
    ]) ?>

</div>
