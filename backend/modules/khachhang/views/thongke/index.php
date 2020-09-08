<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\chi\models\Employee;
use backend\modules\doanhthu\models\CuaHang;
use backend\modules\chi\models\Chingay;
if ($_POST) {
	$title = 'Thống kê chi tiết : '.$data['khachhang']->name;
}else {
	$title = 'Tra cứu thống kê ';
}
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
$chi = new Chingay();
?>
<div class="row formsearch">
	<?php  echo $this->render('_search', ['model' => $searchModel,'dataKhachhang'=>$dataKhachhang]); ?>
</div>
<div class="inhoadon">
<?php if (!empty($data)): 
	$employee = new Employee();
	$khachhang = $data['khachhang'];
	$dichvu = $data['dichvu'];
	$cuahang = new CuaHang();
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<!-- ====================== START ROW ===================== -->
				<div class="col-md-12 col-lg-12 col-xlg-12">
						<h4 class="card-title text-center"><?= $khachhang->name ?><span class="pull-right"> Tổng tiền : <?= Yii::$app->formatter->asDecimal($data['tongtien'],0) ?></span></h4>
						<?php if (!empty($khachhang)): ?>
							<p class="button_save" style="right: 95px;">
								<?= Html::a('Thêm DV', ['/khachhang/khachhangdichvu/create','idKH'=>$khachhang->idKH,'phone'=>$khachhang->phone], ['class' => 'btn btn-success button_luu','target'=>'_blank']) ?>
							</p>
								
						<?php endif ?>
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
									<td><?= $khachhang->name?></td>
									<td><?= $khachhang->phone?></td>
									<td><?= $khachhang->address?></td>
									<td><?= $khachhang->note ?></td>
								</tbody>
							</table>
						<div class="card-columns">
							<?php $i=1; foreach ($dichvu as $keydv => $dichv): 
							?>
								<div class="card p-2">
									<div class="card-body">
										<h4 class="card-title text-center text-info">Ngày : <?= Yii::$app->formatter->asDate($dichv->day, 'dd-M-Y')  ?><span class="pull-right pr-4 text-primary">Số phiếu: <?= $dichv->sophieu ?></span></h4>
										<div class="table-responsive">
											<table class="table full-color-table full-success-table hover-table">
												<thead>
													<tr>
														<th>Cửa hàng</th>
														<th>Xe làm</th>
														<th>Nhân viên</th>
														<th>Quản Lý</th>
														<th>Kế toán</th>
														<th>Thành tiền</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?= $cuahang->getName($dichv->cuahang_id) ?></td>
														<td><?= $danhsachXe[$dichv->id_xe] ?></td>
														<td><?= $employee->getListNhanvien($dichv->id_nhanvien) ?></td>
														<td><?= $employee->getName($dichv->id_quanly) ?></td>
														<td><?= $employee->getName($dichv->id_ketoan) ?></td>
														<td><?= Yii::$app->formatter->asDecimal($dichv->total_money,0) ?></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="table fixed-table-body">
											<table class="table full-color-table full-warning-table hover-table">
												<tbody>
													<?php 
													$chitiet = $dichv->chitietdv;
													foreach ($chitiet as $keyct => $chitiet): 
														 ?>
														<tr class="">
															<td><?= $keyct+1 ?></td>
															<td><?= ltrim($listDichvu[$chitiet->id_Pro_dv],'--') ?></td>
															<td><?= $chitiet->quantity ?></td>
															<td><?= $chitiet->price ?></td>
														</tr>
													<?php endforeach ?>
												</tbody>
												<thead>
													<tr>
														<th>STT</th>
														<th>Sản phẩm / dịch vụ</th>
														<th>Số lượng</th>
														<th>Thành tiền </th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							<?php $i++; endforeach ?>
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
	<?php else: ?>
		<p class="button_save" style="right: 95px;">
			<?= Html::a('Thêm Khách hàng', ['/khachhang/khachhang/create'], ['class' => 'btn btn-info button_luu']) ?>
		</p>
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