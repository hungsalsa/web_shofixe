<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Cập nhật trạng thái dịch vụ';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="text-center">Cập nhật trạng thái xuất dịch vụ khách hàng từ: <?= date('d/m/Y', strtotime('-1 day', strtotime(date("Y/m/d")))); ?> trở về trước</h1>

<div class="chingay-search col-md-10 col-md-offset-1">

    <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => false,
                ]); 
    ?>
    <?= $form->field($model, 'capnhat',['options'=>['class'=>'col-md-2 ml-5']])->checkbox(['class'=>' display-3']) ?>

    <div class="form-group">
        <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-primary button_luu','style'=>'padding: 3px 10px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<div class="clearfix"></div>
    <div class="row clearfix">
        <table class="col-md-8 col-md-offset-1">
            <tbody>
                <?php foreach ($count['cuahang_id'] as $value): 
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
    <div class="row clearfix">
		<table class="col-md-12">
			<tbody>
            	<?php foreach ($data as $value): ?>
				<tr>
					<td><?= $value->day ?></td>
					<td><?= ($value->status ==0 )? 'Lưu tạm':'' ?></td>
                    <td><?= $dataKhachhang[$value->id_kh] ?></td>
					<td><?= $cuahang[$value->cuahang_id] ?></td>
				</tr>
            	<?php endforeach ?>
			</tbody>
			<thead>
				<tr>
					<td>Ngày</td>
					<td>Trạng thái</td>
                    <td width="60%">Khách hàng</td>
					<td>Cửa hàng</td>
				</tr>
			</thead>
		</table>
    </div>


<?php $this->registerCss("
	td{
		padding: 5px 12px;
		text-align: center;
		border: 1px solid;
	}
	
");
?>