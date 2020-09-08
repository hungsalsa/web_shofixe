<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="text-center"><?= $title ?></h1>

<div class="col-md-8 col-md-offset-3">
    <?php // echo $this->render('../update/_search', ['model' => $model]); ?>
</div>
<div class="clearfix"></div>
<div class="row clearfix">
    <table class="col-md-8 col-md-offset-1">
        <tbody>

            <?php 
//             echo '<pre>';print_r($count['cuahang_id']);
// die;
            foreach ($count['cuahang_id'] as $value): 
                if (!isset($count[$value])) {
                    continue;
                }
                ?>
                <tr>
                    <td><?= $cuahang[$value] ?></td>
                    <td><?= $count[$value] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <thead>
            <tr>
                <td>Cửa hàng</td>
                <td>Tổng số phiếu</td>
            </tr>
        </thead>
    </table>
</div>
<div class="card-body">
<div class="table-responsive">
    <table class="table color-table danger-table">
        <tbody>
            <?php foreach ($data as $value): ?>
                <tr>
                    <td><?= Html::a(Yii::$app->formatter->asDate($value->day, 'dd-M-Y'),['view','id'=>$value->id_transfer]) ?></td>
                    <td><?= ($value->status ==0 )? 'Lưu tạm':'Đã chuyển-chưa chấp nhận' ?></td>
                    <td><?= $cuahang[$value->cuahang_id] ?></td>
                    <td><?= $cuahang[$value->chuyenden_cuahang] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <thead>
            <tr>
                <td>Ngày</td>
                <td>Trạng thái</td>
                <td>Chuyển từ</td>
                <td>Đến cửa hàng</td>
            </tr>
        </thead>
    </table>
</div>
    </div>

<?php $this->registerCss("
	td{
		padding: 5px 12px;
		text-align: center;
		border: 1px solid;
	}
	
");
?>