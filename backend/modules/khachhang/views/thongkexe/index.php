<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\Employee;
use backend\modules\quantri\models\CuaHang;
use backend\modules\khachhang\models\KhDichvu;
use backend\modules\khachhang\models\KhachhangDichvuList;

if ($_POST) {
	$title = 'Thống kê chi tiết : '.$data['khachhang']['name'];
}else {
	$title = 'Tra cứu thống kê ';
}
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row formsearch">
	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<div class="inhoadon">
<?php if (!empty($data)): 
	$employee = new Employee();
	$Xe_KH = $data['khachhang']['xeKH'];
	$cuahang = new CuaHang();
	$new_dich_vu = new KhachhangDichvuList();
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<!-- ====================== START ROW ===================== -->
				<div class="col-md-12 col-lg-12 col-xlg-12">
						<h4 class="card-title text-center"><?= $data['khachhang']['name'] ?><span class="pull-right"> Tổng tiền : <?= Yii::$app->formatter->asDecimal($data['tongtien'],0) ?></span></h4>
							<table class="table">
								<thead>
									<tr>
										<td>Tên khách hàng</td>
										<td>Số ĐT khách hàng</td>
										<td>Địa chỉ</td>
										<td>Ghi chú</td>
									</tr>
								</thead>
								<tbody>
									<td><?= $data['khachhang']['name']?></td>
									<td><?= $data['khachhang']['phone']?></td>
									<td><?= $data['khachhang']['address']?></td>
									<td><?= $data['khachhang']['note']?></td>
								</tbody>
							</table>
						<div class="card-columns">

							<?php foreach ($Xe_KH as $xe): ?>
								<h2 class="text-center">Xe : <?= $danhsachXe[$xe['xe']].' BKS: '.$xe['bks'] ?></h2>
								<?php if (empty($data['dichvu'])): ?>
									
									<h4 class="card-title text-left text-info">Xe này của <?= $data['khachhang']['name'] ?> chưa có dịch vụ nào</h4>
								<?php endif ?>
								<?php foreach ($data['dichvu'] as $dichvu): 
									if ($xe['id'] != $dichvu['id_xe']) {
										continue;
									}
									// dbg($dichvu['phieu']['so_phieu']);
									?>
									<div class="card p-2">
										<div class="card-body">
											<h4 class="card-title text-left text-info">Ngày : <?= Yii::$app->formatter->asDate($dichvu['day'], 'dd-M-Y')  ?>
												<span class="pull-right pr-4 text-primary">Số phiếu: <?= $dichvu['phieu']['so_phieu'] ?></span>
												<?= Html::a('In hóa đơn', ['/khachhang/khachhangdichvu/print', 'id' => $dichvu['iddv']], ['class' => 'btn btn-danger pull-right','style'=>'margin: -7px 20px;']) ?>
												
											</h4>
											<div class="clearfix"></div>
											<div class="table-responsive">
												<table class="table color-bordered-table info-bordered-table">
													<thead>
														<tr>
															<th>Cửa hàng</th>
															<th>Kỹ thuật</th>
															<th>Quản Lý</th>
															<th>Kế toán</th>
															<th>Thành tiền</th>
														</tr>
														
													</thead>
													<tbody>
														<tr>
															<td><?= $cuahang->getName($dichvu['cuahang_id']) ?></td>
															<td><?= $employee->getListNhanvien($dichvu['id_nhanvien']) ?></td>
															<td><?= $employee->getName($dichvu['id_quanly']) ?></td>
															<td><?= $employee->getName($dichvu['id_ketoan']) ?></td>
															<td><?= Yii::$app->formatter->asDecimal($dichvu['total_money'],0) ?></td>
														</tr>
														<tr>
															<th colspan="2">Tình trạng ban đầu: <?= $dichvu['bandau'] ?></th>
														
															<th colspan="2">Tồn tại: <?= $dichvu['tontai'] ?></th>
														
															<th colspan="">Ghi chú: <?= $dichvu['note'] ?></th>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="table fixed-table-body">
												<table class="table color-bordered-table success-bordered-table">
													<tbody>
														<?php 
														$chitiet = $dichvu['chitietdv'];
														foreach ($chitiet as $keyct => $chitiet): 
															// dbg($chitiet);
															?>
															<tr class="">
																<td><?= $keyct+1 ?></td>
																<td><?= (isset($listDichvu[$chitiet['id_Pro_dv']])) ? ltrim($listDichvu[$chitiet['id_Pro_dv']],'--'): '' ?></td>
																<td><?= ($new_dich_vu->baohanh($chitiet['id_Pro_dv']) !='')? sprintf("%02d".' tháng', $new_dich_vu->baohanh($chitiet['id_Pro_dv'])):'(không)' ?></td>
																<td><?= $chitiet['quantity'] ?></td>
																<td><?= $chitiet['price'] ?></td>
																<td><?= $chitiet['price']*$chitiet['quantity'] ?></td>
															</tr>
														<?php endforeach ?>
													</tbody>
													<thead>
														<tr>
															<th>STT</th>
															<th>Sản phẩm / dịch vụ</th>
															<th>Bảo hành</th>
															<th>Số lượng</th>
															<th>Đơn giá </th>
															<th>Thành tiền </th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
										
									<br>
								<?php endforeach ?>
								
							<?php endforeach ?>
							<!-- <div class="col-md-6 col-lg-6 col-xlg-6"> -->
								<!-- </div> -->
								<!-- <div class="clearfix"></div> -->
							</div>
						<div class="" id="sales-chart" style="height: 355px;"></div>
						<!-- ====================== START END ===================== -->
					</div>
					<!-- Column -->
				</div>
			</div>
		</div>
	</div>
		
	<?php endif ?>
	<!-- ============================================================== -->
	<!-- End Info box -->
	<!-- ============================================================== -->
</div>
<?php $this->registerCss("
	#main-wrapper{
	margin-top: -22px;
}
	@media (min-width: 34em) {
		.card-columns {
			-webkit-column-count:1;
			-moz-column-count:1;
			column-count:1;
		}
		}
		@media print {
			.left-sidebar,.right-side-toggle,.formsearch,p.button_save{
			    display: none;
			}
			.inhoadon {
				background-color: white;
				height: 100%;
				width: 100%;
				position: fixed;
				top: 0;
				left: 0;
				margin: 0;
				padding: 15px;
				font-size: 14px;
				line-height: 18px;
			    color: black !important;
			}
			td{
				border: 1px solid black;
			}
			.table{
				border-collapse: collapse;
				empty-cells: show;
			}
		}
");
?>
<?php //$this->registerJsFile('@web/js/dichvu/khachhang_thongke.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>
