<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChingaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
$this->title = 'Thống kê sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
$product = new Product();
$cate = new ProductCate();

?>

<div class="row formsearch">
	<?php  echo $this->render('_search', ['model' => $searchModel,'dataCuahang'=>$cuahang,'dataCate' => $dataCate]); ?>
</div>
<div class="inhoadon">

<div class="row thongke">
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
	<!-- Column   -->
</div>


<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">

				<!-- ====================== START ROW ===================== -->
				<div class="col-md-12 col-lg-12 col-xlg-12">

					<?php foreach ($cuahang_query as $keycuahang => $cuahang): ?>
						<div class="alert alert-info text-center font-bold mt-3 mb-0">Cửa hàng : <?= $cuahang ?> <span class="m-lg-5">Ngày: <?= date("d-m-Y") ?></span><span class="pull-right"> Tổng số lượng : <?= $product->getProductQuantity($keycuahang); ?></span></div>
						<div class="card-columns">
							<?php foreach ($dataCate_query as $keycate => $valuecate): 
								if(empty($product->getProductThongke($keycuahang,$keycate))):
									$idListCate = $cate->getAllIDCate($keycate); 
									$countPro = $product->getProductQuantity($keycuahang,$idListCate);
							 ?>
							 <div class="alert alert-primary text-center font-bold mb-0"><?= $valuecate ?> <span class="pull-right"> Tổng số lượng : <?= ($countPro==0)? 0 :$countPro ?></span></div>

							 <?php else: ?>
									<div class="card">
										<div class="card-body p-0">
											<div class="alert alert-info text-center font-bold"><?= $valuecate  ?> <i class="pull-right">  Tổng số lượng : <?= $product->getProductQuantity($keycuahang,$keycate) ?></i></div>

											<div class="table fixed-table-body">
												<table class="table">
													
													<tbody>
														<?php $check = false;
														$data = $product->getProductThongke($keycuahang,$keycate);
														foreach ($data as $keypro =>  $valuepro): 
														
														if(!empty($valuepro)){
															$check = true;
														}
														?>
														<tr class="">
															<td><?= $keypro+1 ?></td>
															<td><?= $valuepro->idPro ?></td>
															<td><?= $valuepro->proName ?></td>
															<td><?= $valuepro->quantity ?></td>
															<td><?= Yii::$app->formatter->asDatetime($valuepro->updated_at,"php:H:i:s -->  d-m-Y") ?></td>
															
														</tr>

													<?php  endforeach ?>
												</tbody>
												<?php if($check): ?>
												<thead>
													<tr>
														<th>STT</th>
														<th>Mã SP</th>
														<th>Tên SP</th>
														<th>Số lượng</th>
														<th>Ngày cập nhật</th>
													</tr>
												</thead>
											<?php endif ?>
											</table>

										</div>
									</div>
								</div>

							
						<?php endif; endforeach ?>
									
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
		.left-sidebar,.right-side-toggle,.formsearch,.thongke,footer{
			display: none;
		}
	}
");
?>
