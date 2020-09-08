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

$countSP = new SanphamThongke();
$cate = new ProductCate();
$data = Yii::$app->cache->get('cache_app_sanpham_ton');
// dbg(array_keys($search['cuahang']));
?>
<div class="sanpham-thongke-index chuthich">
    <h1>
    	<?= Html::encode($this->title) ?>
    	<?php if (getUser()->manager==1): ?>
		    <?= Html::a('cập nhật tất cả',['/common/sanpham-thongke/capnhatton'],
		    	[
		    		'class'=>'btn btn-success btn-outline p-4',
		    		'data' => [
		    			'method' => 'post',
		    			'params' => [
		    				'cuahang'=>array_keys($search['cuahang'])
		    			]
		    		]
		    ]) ?>
    		
    	<?php endif ?>
    	
    </h1>
    <div class="clearfix"></div>
    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['searchModel' => $searchModel,'search'=>$search,'dataProduct'=>$dataProduct]); ?>
    <?php Pjax::end(); ?>
</div>

 <?php foreach ($search['cuahang_query'] as $keyCH => $cuahang): ?>
	<div class="panel panel-info">
	 	<div class="panel-heading">
	 		<?= $cuahang ?>  / Ngày: <?= date("d-m-Y") ?>
	 		<?php if (getUser()->manager!=1): ?>
	 		<span class="chuthich" style="margin-left: 200px"> Hãy <?= Html::a('cập nhật','/backend/common/sanpham-thongke/capnhatton',['class'=>'btn btn-danger btn-outline p-4','data' => ['method' => 'post', 'params' => ['cuahang' => [$keyCH]]]]) ?> số lượng tồn trước khi thống kê</span><?php endif ?>
	 		<div class="pull-right">
	 		  Tổng số lượng tồn : <?= ($countSP->getProductQuantity($keyCH) > 0) ? $countSP->getProductQuantity($keyCH): 0 ?>
	 		  <a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
	 	</div>
		<div class="panel-wrapper collapse in"  aria-expanded="true">
			<div class="panel-body">
	 	<?php if (empty($data)): ?>
	 		<h4 class="text-center">Không có sản phẩm nào <br>Hãy <?= Html::a('cập nhật','/backend/common/sanpham-thongke/capnhatton',['class'=>'btn btn-danger btn-outline p-4','data' => ['method' => 'post', 'params' => ['cuahang' => [$keyCH]]]]) ?> số lượng tồn trước khi thống kê</h4> 
	 	<?php else: ?>
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
			 								<?php $i = 1;   foreach ($data as $keysp => $value): ?>
			 									<?php 
				 								
				 									if ($value['cuahang_id'] != $keyCH || $value['cate_id'] != $keyCate ){continue;}
				 									if (!in_array($value['masp'],$dataProductquery)){continue;} 
				 									// if ($value['masp']=='3528708949355' && $value['cuahang_id']== 2){
				 									// 	dbg($value);
				 									// }
			 									?>
			 									<tr>
			 										<td><?= $i ?></td>
			 										<td><?= $value['masp'] ?></td>
			 										<td><?= $value['proName'] ?></td>

			 										<td><?= $value['sldauky']?></td>
			 										<!-- <td><?php $value['tiendauky'] ?></td> -->

			 										<td><?= $value['slnhap'] + $value['slnhapnb'] ?></td>
			 										<!-- <td><?php Yii::$app->formatter->asInteger($value['tiennhap'])?></td> -->
			 										<td><?= $value['slxuat'] + $value['slxuatnb'] ?></td>
			 										 <!-- <td><?php Yii::$app->formatter->asInteger($value['tienxuat'])?></td> -->

			 										<td><?= $value['slton'];?></td>
			 									</tr>
			 								<?php $i++; endforeach ?>
			 							</tbody>
			 							<thead>
			 								<tr>
			 									<th>STT</th>
			 									<th>Mã sản phẩm</th>
			 									<th>Tên sản phẩm</th>
			 									<th class="text-center" width="7%">Đầu kỳ</th>
			 									<th class="text-center" width="7%">Nhập</th>
			 									<th class="text-center" width="7%">Xuất</th>
			 									<th class="text-center" width="7%">Tồn </th>
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
		<?php endif ?>
		</div>
		</div>
	</div>
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
