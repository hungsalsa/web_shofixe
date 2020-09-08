<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\common\models\SanphamThongke;
use backend\modules\sanpham\models\ProductCate;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\common\models\SanphamThongkeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thống kê sản phẩm';
$this->params['breadcrumbs'][] = $this->title;

// echo count($data);
// echo '<pre>';print_r($data);
// die;
$countSP = new SanphamThongke();
$cate = new ProductCate();
?>
<div class="sanpham-thongke-index chuthich">

    <h1 class="col-md-6"><?= Html::encode($this->title) ?></h1><h3 class="pull-right col-md-6">Hãy <?= Html::a('cập nhật','/backend/common/sanpham-thongke/capnhatton',['target'=>'_blank']) ?> số lượng tồn trước khi thống kê</h3>
    <div class="clearfix"></div>
    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['searchModel' => $searchModel,'search'=>$search,'dataProduct'=>$dataProduct]); ?>
    <?php Pjax::end(); ?>
</div>

 <?php foreach ($search['cuahang_query'] as $keyCH => $cuahang): ?>

 	<div class="white-box">
 		<h3 class="box-title" style="font-size: 32px;"><?= $cuahang ?>  / Ngày: <?= date("d-m-Y") ?>  Tổng số lượng tồn: <?= $countSP->getProductQuantity($keyCH) ?></h3> 
 	</div>
 	<?php foreach ($search['category_query'] as $keyCate => $category): ?>

 	<div class="panel panel-default">
 		<?php $check = $countSP->checkCountSP($keyCH,$keyCate);
 		if ($check): ?>
 		 	
 		<div class="panel-heading text-center"><?= $category ?> <span style="margin-left: 30px"></span>Tổng số lượng: <?= $countSP->getProductQuantity($keyCH,[$keyCate]); ?>
 			<div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a></div>
 		</div>
 		<div class="panel-wrapper collapse in" aria-expanded="true">
 			<div class="panel-body" style="padding: 0">
 				
 					<div class="table-responsive">
 						<table class="table full-color-table full-success-table hover-table thonhke">
 							<tbody>
 								<?php $i = 1;   foreach ($data as $value): ?>
 									<?php if ($value['cuahang_id'] != $keyCH){continue;} ?>
 									<?php if ($value['cate_id'] != $keyCate){continue;} ?>
 									<tr>
 										<td><?= $i ?></td>
 										<td><?= $value['masp'] ?></td>
 										<td><?= $value['proName'] ?></td>

 										<td><?= $value['sldauky']?></td>
 										<td><?= $value['tiendauky'] ?></td>

 										<td><?= $value['slnhap'] + $value['slnhapnb'] ?></td>
 										<td><?= $value['tiennhap'] ?></td>


 										<td><?= $value['slxuat'] + $value['slxuatnb'] ?></td>
 										<td><?= $value['tienxuat'] ?></td>

 										<td><?= $value['slton'];?></td>
 									</tr>

 								<?php $i++; endforeach ?>
 							</tbody>
 							<thead>
 								<tr>
 									<th class="row2" rowspan="2">STT</th>
 									<th class="row2" rowspan="2">Mã sản phẩm</th>
 									<th class="row2" rowspan="2">Tên sản phẩm</th>
 									<th class="text-center" colspan="2">Đầu kỳ</th>
 									<th class="text-center" colspan="2">Nhập</th>
 									<th class="text-center" colspan="2">Xuất</th>
 									<th class="text-center">Tồn </th>
 								</tr>
 								<tr>
 									<th>Số lượng</th>
 									<th>Thành tiền</th>
 									<th>Số lượng</th>
 									<th>Thành tiền</th>
 									<th>Số lượng</th>
 									<th>Thành tiền</th>
 									<th>Số lượng</th>
 								</tr>
 							</thead>
 						</table>
 					</div>
 			</div>
 		</div>
 		<?php else: 
 		 	$idListCate = $cate->getAllIDCate($keyCate); 
 		 	$countPro = $countSP->getProductQuantity($keyCH,$idListCate);
	 	?>
	 	<div class="panel-heading text-center"><?= $category ?> <span style="margin-left: 30px"></span>Tổng số lượng: Tổng số lượng : <?= ($countPro==0)? 0 :$countPro ?>
		 	<div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a></div>
		 </div>
 		 <?php endif ?>
 	</div>	

<?php endforeach ?>
<?php endforeach ?>
<?php $this->registerCss("
	.table.hover-table>thead>tr>th{
	    border: 1px solid #fff !important;
	    font-size: 18px;
	}
	.thonhke.table.hover-table th,.thonhke.table.hover-table td{
		border: 1px solid #fff !important;
	}
	@media print {
		.navbar-default.sidebar,.formsearch,.chuthich{
			display: none;
		}

		.thonhke.table.hover-table th,.thonhke.table.hover-table td{
			border: 1px solid #fff !important;
		}
		 #page-wrapper{margin-top: 0 !important}
		 #page-wrapper .container-fluid{margin-top: 0 !important}

	}
");
?>
