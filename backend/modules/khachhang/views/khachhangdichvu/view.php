<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use backend\modules\quantri\models\Employee;
use backend\modules\khachhang\models\KhXe;
/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhDichvu */

$this->title = 'Ngày: '.Yii::$app->formatter->asDate($model->day, 'dd-M-Y').' / '.$model->khachhang->name.' /xe : '.$model->xesua->bks;
$this->params['breadcrumbs'][] = ['label' => 'Kh Dichvus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kh-dichvu-view">

    <h1><?= Html::encode($this->title) ?></h1>
<!-- if($model->user_add != getUser()->id && getUser()->manager != 1){ -->
    <p class="btn_save">
        <?= Html::a('Thêm mới khách', ['/khachhang/khachhang/create'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Thêm mới dịch vụ', ['/khachhang/khachhangdichvu/create', 'idKH' => $model->khachhang->idKH, 'phone' => $model->khachhang->phone], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success button_luu']) ?>

        <?= Html::a('In hóa đơn', ['print', 'id' => $model->iddv], ['class' => 'btn btn-danger button_luu']) ?>
        <?php if (getUser()->manager == 1 || $model->status != 1 && $model->user_add == getUser()->id ): ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->iddv], [
            'class' => 'btn btn-danger button_luu',
            'data' => [
                'confirm' => 'Bạn có chắc muốn xóa dịch vụ khách : '.$model->khachhang->name.' ngày : '.Yii::$app->formatter->asDate($model->day,'d/M/Y').' ?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif ?>
        <?php if (in_array($model->cuahang_id, json_decode(getUser()->cuahang_id)) && getUser()->manager != 1): ?>
        <?= Html::a('Update', ['update', 'id' => $model->iddv], ['class' => 'btn btn-primary button_luu']) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'iddv',
            [
                'attribute' => 'day',
                'contentOptions' => ['style' => 'color:#f00;font-size:18px'],
                'format' => ['date', 'php: d-m-Y']
            ],
            [
                'attribute'=>'cuahang_id',
                'value'=>$model->cuahang->name,
            ],
            [
                'attribute'=>'id_kh',
                'value'=>$model->khachhang->name.' SĐT: '.$model->khachhang->phone,
            ],
            [
                'attribute'=>'id_xe',
                'value'=>function($data){
                    $xe = new KhXe();
                    return $xe->getTTXe($data->id_xe);
                },
            ],
            [
                'attribute'=>'id_ketoan',
                'value'=>$model->ketoan->name,
            ],
            [
                'attribute'=>'id_quanly',
                'value'=>$model->quanly->name,
            ],
            [
                'attribute'=>'id_nhanvien',
                'value'=>function ($data)
                {
                    if ($data->id_nhanvien != '') {
                        $id_nhanvien = json_decode($data->id_nhanvien);
                        $idNV = '';
                        $nv= new Employee();
                        foreach ($id_nhanvien as $value) {
                            $idNV .= $nv->getName($value).'-';
                        }
                        return rtrim($idNV,'-');
                    }else {
                        return '';
                    }
                },
            ],
            // 'sophieu',
            [
                'attribute' =>'sophieu',
                'value'=>$model->phieu->so_phieu,
                'contentOptions' => ['class' => 'text-success font-weight-bold','style' => 'font-size:18px'],
            ],
            [
                'attribute' =>'tienthu_kh',
                'format'=>['decimal',0],
                'value'=>$model->tienthu_kh*1000,
                'contentOptions' => ['style' => 'color:#f00;font-size:18px'],
            ],
            [
                'attribute' =>'total_money',
                'format'=>['decimal',0],
                'value'=>$model->total_money*1000,
                'contentOptions' => ['style' => 'color:#f00;font-size:18px','width'=>'85%'],
            ],
            [
                'attribute' => 'thanhtoan',
                'value'=>function ($data)
                {
                    $thanhtoan = [0 =>'Tiền mặt',1=>'Thanh toán thẻ',2=>'Chuyển khoản'];
                    return $thanhtoan[$data->thanhtoan];
                },
            ],
            'time_from',
            'time_to',
            [
                'attribute' => 'bandau',
                'format' => 'html',
            ],
            [
                'attribute' => 'tontai',
                'format' => 'html',
            ],
            [
                'attribute' => 'note',
                'format' => 'html',
            ],
            [
                'attribute' => 'status',
                'value'=>function ($data)
                {
                    $dataStatus = [0 =>'Lưu tạm',1=>'Đã xuất',2=>'Chưa thanh toán'];
                    return $dataStatus[$data->status];
                },
            ],
            
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i  ->   d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i  ->   d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>function($data){
                    if($data->user->fullname !=''){
                        return $data->user->fullname;
                    }else {
                        return $data->user->username;
                    }
                    
                }
            ],
        ],
    ]) ?>

    <h3>Chi tiết dịch vụ khách hàng</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute'=>'id_Pro_dv',
                'label'=>'Mã dịch vụ',
                'value'=>'danhsachdv.madichvu',
            ],
            /*[
                'attribute'=>'id_Pro_dv',
                'value'=>'danhsachdv.tendv',
            ],*/
            [
                'attribute'=>'id_Pro_dv',
                'value'=>function ($data)
                {
                    // pr($data);
                    // pr($data->danhsachdv);
                    if ($data->danhsachdv) {
                        return $data->danhsachdv->tendv.' '.$data->suffixes;
                    } else {
                        return $data->id_Pro_dv;
                        
                    }
                    // return $data->danhsachdv->tendv.' '.$data->suffixes;
                },
            ],
            [
                'attribute'=>'id_Pro_dv',
                'value'=>function ($data)
                {
                    if ($data->danhsachdv) {
                        return ($data->danhsachdv->guarantee !='')? sprintf("%02d".' tháng', $data->danhsachdv->guarantee):'(không)';
                    } else {
                        return $data->id_Pro_dv;
                        
                    }
                    // return $data->id_Pro_dv;
                    // return ($data->danhsachdv->guarantee !='')? sprintf("%02d".' tháng', $data->danhsachdv->guarantee):'(không)';
                },
                'label'=>'Bảo hành'
            ],
            // 'suffixes',
            [
                'attribute' =>'quantity',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'price',
                'format'=>['decimal',0],
                'value'=>function ($data)
                {
                    return $data->price*1000;
                },
            ],
            //'user_update',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
