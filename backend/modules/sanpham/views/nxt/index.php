<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChingaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Thống kê sản phẩm nhập xuất tồn';
$this->params['breadcrumbs'][] = $this->title;

// $datactt = $chitiet->Total_number_Money(1);
?>
<div class="row formsearch">
	<?php  echo $this->render('_search', ['model' => $searchModel,'dataCuahang'=>$cuahang,'dataCate' => $dataCate,'listProduct'=>$listProduct]); ?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">

				<!-- ====================== START ROW ===================== -->
				<div class="col-md-12 col-lg-12 col-xlg-12">

					<?php foreach ($cuahang_query as $keycuahang => $cuahang): ?>
						<div class="alert alert-info text-center font-bold mt-3 mb-0">Cửa hàng : <?= $cuahang ?> <span class="m-lg-5">Ngày: <?= date("d-m-Y") ?></span><span class="pull-right"> Tổng số lượng : <?= 'tóngl' ?></span></div>

						<?php foreach ($dataCate_query as $keycate => $valuecate): ?>

							 <div class="card">
										<div class="card-body p-0">
											<div class="alert alert-info text-center font-bold"><?= $valuecate  ?> <i class="pull-right">  Tổng số lượng : <?= 100 ?></i></div>

											<div class="table fixed-table-body">
												<table class="table table-bordered">
													
													<tbody>
														<?php $check = false;
														foreach ($dataPro as $keypro =>  $valuepro): 
														
														if(!empty($valuepro['cate_id'] != $keycate)){
															continue;
															$check = true;
														}

														
														?>
														<tr class="">
															<td><?= $keypro+1 ?></td>
															<td><?= Html::a($valuepro['idPro'],Url::toRoute(['view', 'id' => $valuepro['id']])) ?></td>
															<td><?= $valuepro['proName'] ?></td>
															<td><?= $valuepro['sldauky'] ?></td>
															<td><?= Yii::$app->formatter->asDecimal($valuepro['sldauky'],0) ?></td>
															
															<td><?= $valuepro['tongslnhap'] ?></td>
															<td><?= Yii::$app->formatter->asDecimal($valuepro['tongtiennhap'],0) ?></td>

															
															<td><?= $valuepro['tongslnhap'] ?></td>
															<td><?= Yii::$app->formatter->asDecimal($valuepro['tongtiennhap'],0) ?></td>

															
															<td><?= $valuepro['tongslnhap'] ?></td>
															<td><?= Yii::$app->formatter->asDecimal($valuepro['tongtiennhap'],0) ?></td>

															
															
														</tr>

													<?php  endforeach ?>
												</tbody>
												<thead>
													<tr>
														<th rowspan="2" class="text-center">STT</th>
														<th rowspan="2" class="text-center" width="5%">Mã SP</th>
														<th rowspan="2" class="text-center name">Tên SP</th>
														<th colspan="2" class="text-center">Tồn đầu kỳ</th>
														<th colspan="2" class="text-center">Nhập trong kỳ</th>
														<th colspan="2" class="text-center">Xuất trong kỳ</th>
														<th colspan="2" class="text-center">Tồn cuối kỳ</th>
													</tr>
														<th>Số lượng</th>
														<th>Thành tiền</th>
														<th>Số lượng</th>
														<th>Thành tiền</th>
														<th>Số lượng</th>
														<th>Thành tiền</th>
														<th>Số lượng</th>
														<th>Thành tiền</th>
													</tr>
												</thead>
											</table>

										</div>
									</div>
								</div>



						 	<?php  endforeach ?>
									

					

				<?php endforeach ?>	
				<!-- ====================== START END ===================== -->
				</div>
				<!-- Column -->
			</div>
		</div>
	</div>
</div>