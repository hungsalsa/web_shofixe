<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChingaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use backend\modules\chi\models\Chingay;
$this->title = 'Danh sách các khoản chi theo ngày';
$this->params['breadcrumbs'][] = $this->title;

$chi = new Chingay();
?>
<div class="row formsearch">
	<?php  echo $this->render('_search', ['model' => $searchModel,'dataCuahang'=>$cuahang]); ?>
</div>
<div class="inhoadon">

<div class="row">
	<!-- Column -->
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
	<!-- Column -->
	<!-- Column -->
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
	<!-- Column -->
	<!-- Column -->
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
	<!-- Column -->
	<!-- Column -->
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
	<!-- Column -->
	<!-- Column -->
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title text-center">Các khoản chi bạn quản lý</h5>

				<!-- ====================== START ROW ===================== -->
				<div class="col-md-12 col-lg-12 col-xlg-12">

					<?php foreach ($cuahang_query as $keycuahang => $cuahang): ?>
						<h4 class="card-title text-center"><?= $cuahang ?></h4>
						<div class="card-columns">
							
								
							
							<?php foreach ($loaichis as $keychi => $valuechi): $total = 0; ?>

								
									<div class="card p-2">
										<div class="card-body">
											<h4 class="card-title"><?= $valuechi  ?></h4>
											<div class="table fixed-table-body">


												

												<table class="table">
													<?php foreach ($data as  $value): 
														if ( $value->cuahang_id != $keycuahang) {
															continue;
														}
														$chitietchi = $value->chitietchi;
														
														?>
													<tbody>

														<?php foreach ($chitietchi as $key => $chitiet): 
														if ($chitiet['type'] != $keychi) {
															continue;
														}

														$total += $chitiet['money']; ?>
														<tr class="">
															<td><?= $key+1 ?></td>
															<td><?= Yii::$app->formatter->asDatetime($value->day,"php:d-m-Y").' cửa hàng: '.$value->cuahang_id ?></td>
															<td><?= $chitiet['type'] ?></td>
															<td><?= $chitiet['items_name'] ?></td>
															<td><?=  Yii::$app->formatter->asDecimal($chitiet['money'],0) ?></td>
															<td><?= $chitiet['accounting_id'] ?></td>
															<td><?= $chitiet['employee_id'] ?></td>
														</tr>
													<?php endforeach ?>
												</tbody>
												<?php endforeach ?>
												
												<thead>
													<tr>
														<th>STT</th>
														<th>Ngày chi</th>
														<th>Loại chi</th>
														<th>Tên khoản chi</th>
														<th>Số tiền </th>
														<th>Kế toán </th>
														<th>Người chi </th>
													</tr>
												</thead>
											</table>

										</div>
										<h4 class="card-title pull-right text-danger"> Tổng tiền : <?= Yii::$app->formatter->asDecimal($total,0) ?></h4>
									</div>
								</div>
							
						<?php endforeach ?>
									<!-- <div class="col-md-6 col-lg-6 col-xlg-6"> -->
										
										<!-- </div> -->
									
								<!-- <div class="clearfix"></div> -->
							</div>
						<?php endforeach ?>					 
						<div class="" id="sales-chart" style="height: 355px;"></div>

						<!-- ====================== START END ===================== -->


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
			.left-sidebar,.right-side-toggle,.formsearch{
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
		}
");
?>
