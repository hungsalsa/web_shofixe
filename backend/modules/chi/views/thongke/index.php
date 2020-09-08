<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChingaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Danh sách các khoản chi theo ngày';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row formsearch">
	<?php  echo $this->render('_search', ['model' => $searchModel,'dataCuahang'=>$cuahang,'dataLoaichi'=>$dataLoaichi,'dataMotorbike'=>$dataMotorbike]); ?>
</div>
<div class="inhoadon">
<!-- 
<div class="row">
	Column
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex p-10 no-block">
					<div class="align-slef-center">
						<h2 class="m-b-0">234</h2>
						<h6 class="text-muted m-b-0">New Clients</h6>
					</div>
					<div class="align-self-center display-6 ml-auto"><i class="text-success icon-Target-Market"></i></div>
				</div>
			</div>
			<div class="progress">
				<div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:3px;"> <span class="sr-only">50% Complete</span></div>
			</div>
		</div>
	</div>
	Column
	Column
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex p-10 no-block">
					<div class="align-slef-center">
						<h2 class="m-b-0">$6,759</h2>
						<h6 class="text-muted m-b-0">This Week</h6>
					</div>
					<div class="align-self-center display-6 ml-auto"><i class="text-info icon-Dollar-Sign"></i></div>
				</div>
			</div>
			<div class="progress">
				<div class="progress-bar bg-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:3px;"> <span class="sr-only">50% Complete</span></div>
			</div>
		</div>
	</div>
	Column
	Column
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex p-10 no-block">
					<div class="align-slef-center">
						<h2 class="m-b-0">2,356</h2>
						<h6 class="text-muted m-b-0">Emails Sent</h6>
					</div>
					<div class="align-self-center display-6 ml-auto"><i class="text-primary icon-Inbox-Forward"></i></div>
				</div>
			</div>
			<div class="progress">
				<div class="progress-bar bg-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:3px;"> <span class="sr-only">50% Complete</span></div>
			</div>
		</div>
	</div>
	Column
	Column
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex p-10 no-block">
					<div class="align-slef-center">
						<h2 class="m-b-0">38</h2>
						<h6 class="text-muted m-b-0">Deals in Pipeline</h6>
					</div>
					<div class="align-self-center display-6 ml-auto"><i class="text-danger icon-Contrast"></i></div>
				</div>
			</div>
			<div class="progress">
				<div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:3px;"> <span class="sr-only">50% Complete</span></div>
			</div>
		</div>
	</div>
	Column
	Column
</div> -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title text-center">Các khoản chi bạn quản lý</h5>

				<!-- ====================== START ROW ===================== -->
				<div class="col-md-12 col-lg-12 col-xlg-12">
					<?php foreach ($data['cuahang_query'] as $keycuahang => $cuahang): ?>
					<h4 class="card-title text-center text-danger"><?= $cuahang ?></h4>
					<div class="card-columns">

							<?php foreach ($loaichis as $keychi => $valuechi):  ?>
								<div class="card p-2">
									<div class="card-body">
										
										<div class="table fixed-table-body">
											<table class="table">
												<?php if (!empty($datachi)):?>
												<?php $i = 1; $total = 0; foreach ($datachi as  $value): 
													if ( $value->cuahang_id != $keycuahang) {
														continue;
													}
													$chitietchi = $value->chitiet;
													 // dbg($chitietchi);
													?>
													
													<tbody>
														<?php foreach ($chitietchi as $key => $chitiet):
															// echo $chitiet->khoanchi->loaichi_id.'--'.$keychi;
															// dbg($chitiet->khoanchi->loaichi_id);
															if ($chitiet->khoanchi->loaichi_id != $keychi) {
																continue;
															} 

															if (!empty($postBike) && !in_array($chitiet['motorbike'],$postBike)) {
																continue;
															}
															// dbg($chitiet->ncc);
															$total += $chitiet['quantity']*$chitiet['money']; ?>
															<tr class="">
																<td><?= $i ?></td>
																<td><?= Yii::$app->formatter->asDatetime($value->day,"php:d-m-Y") ?></td>
																<td><?= $chitiet->khoanchi->name ?></td>
																<td><?=  Yii::$app->formatter->asDecimal($chitiet['quantity'],0) ?></td>
																<td><?=  Yii::$app->formatter->asDecimal($chitiet['money'],0) ?></td>
																<td><?= Yii::$app->formatter->asDecimal($chitiet['money']*$chitiet['quantity'],0) ?></td>
																<td><?= $chitiet->ncc->supName ?></td>
															</tr>
														<?php $i++; endforeach ?>
													</tbody>
												<?php endforeach ?>
												<?php endif ?>
												
												<thead>
													<tr>
														<td colspan="8" style="padding:0 20px;"><h4 class="card-title text-info"><?= $valuechi ?><span class="pull-right">Tổng tiền: <?= (isset($total)) ? Yii::$app->formatter->asDecimal($total*1000,0):0 ?></span></h4></td>
													</tr>
													<tr>
														<th class="text-primary">STT</th>
														<th class="text-primary">Ngày chi</th>
														<th class="text-primary">Tên khoản chi</th>
														<th class="text-primary">Số lượng</th>
														<th class="text-primary">Đơn giá </th>
														<th class="text-primary">Thành tiền </th>
														<th class="text-primary">Nguồn nhập </th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							<?php endforeach ?>

							
							<!-- CÁC KHOẢN CHI KHÁC
							<?php $i = 1;  foreach ($loaichis as $keychi => $valuechi):  ?>
								<div class="card p-2">
									<div class="card-body">
										
										<div class="table fixed-table-body">
											<table class="table">
												<?php if (!empty($datachi['khac'])): ?>
												<?php $total = 0; foreach ($datachi['khac'] as  $value): 
													if ( $value->cuahang_id != $keycuahang) {
														continue;
													}
													$chitietchikhac = $value->chitiet;
													?>
													
													<tbody>
														<?php foreach ($chitietchikhac as $key => $chitiet):
															// echo $chitiet->khoanchi->loaichi_id.'--'.$keychi;
															if ($chitiet->khoanchi->loaichi_id != $keychi) {
																continue;
															} 
							
															if (!empty($postBike) && !in_array($chitiet['motorbike'],$postBike)) {
																continue;
															}
															
															$total += $chitiet['quantity']*$chitiet['money']; ?>
															<tr class="">
																<td><?= $i ?></td>
																<td><?= Yii::$app->formatter->asDatetime($value->day,"php:d-m-Y") ?></td>
																<td><?= $chitiet->khoanchi->name ?></td>
																<td><?=  Yii::$app->formatter->asDecimal($chitiet['quantity'],0) ?></td>
																<td><?=  Yii::$app->formatter->asDecimal($chitiet['money'],0) ?></td>
																<td><?= Yii::$app->formatter->asDecimal($chitiet['money']*$chitiet['quantity'],0) ?></td>
																<?php if ($keychi==2): ?>
																	<th class="text-primary"><?= isset(($chitiet->xe->bikeName))? $chitiet->xe->bikeName:'' ?> </th>
							
																<?php endif ?>
																<td><?= $chitiet->nguoichi->name ?></td>
																<td><?= $chitiet->ncc->supName ?></td>
															</tr>
														<?php $i++; endforeach ?>
													</tbody>
												<?php endforeach ?>
												<?php endif ?>
												
												<thead>
													<tr>
														<td colspan="8" style="padding:0 20px;"><h4 class="card-title text-info"><?= $valuechi ?><span class="pull-right">Tổng tiền: <?= (isset($total)) ? Yii::$app->formatter->asDecimal($total*1000,0):0 ?></span></h4></td>
													</tr>
													<tr>
														<th class="text-primary">STT</th>
														<th class="text-primary">Ngày chi</th>
														<th class="text-primary">Tên khoản chi</th>
														<th class="text-primary">Số lượng</th>
														<th class="text-primary">Đơn giá </th>
														<th class="text-primary">Thành tiền </th>
														<?php if ($keychi==2): ?>
														<th class="text-primary">Cho xe </th>
							
														<?php endif ?>
														<th class="text-primary">Người chi </th>
														<th class="text-primary">Nguồn nhập </th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							<?php endforeach ?>
							CÁC KHOẢN CHI KHÁC -->
								
					</div>
					<?php endforeach ?>





				</div>
				<!-- Column -->
			</div>
		</div>
	</div>
</div>

	<!-- ============================================================== -->
	<!-- End Info box -->
	<!-- ============================================================== -->
</div>

<?php $this->registerCss("
	@media (min-width: 34em) {
		.card-columns {
			-webkit-column-count:1;
			-moz-column-count:1;
			column-count:1;
		}

	}
	@media print {
		.navbar-default.sidebar,.navbar.navbar-default.navbar-static-top,.right-side-toggle,.formsearch,.thongke,footer{
			display: none;
		}
	}

");
?>
