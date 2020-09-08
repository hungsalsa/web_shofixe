<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChingaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\chi\models\Chitietchi;
use backend\modules\chi\models\ChiKhoanchi;
use backend\modules\chi\models\Chingay;
use backend\modules\khachhang\models\KhChitietDv;

$this->title = 'Thống kê sản phẩm nhập xuất tồn';
$this->params['breadcrumbs'][] = $this->title;
$product = new Product();
$cate = new ProductCate();


$chitiet = new Chitietchi();
$khoanchi = new ChiKhoanchi();
$dichvu = new KhChitietDv();
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">

				<!-- ====================== START ROW ===================== -->
				<div class="col-md-12 col-lg-12 col-xlg-12">
					<div class="card">
										<div class="card-body p-0">
											<div class="alert alert-info text-center font-bold"><?= $dataPro->proName  ?> <i class="pull-right">  Tổng số lượng :</i></div>

											<div class="table fixed-table-body">
												<table class="table table-bordered">
													
													<tbody>
														<?php
														foreach ($dataNgay as $ngay): 
														foreach ($dataChitiet as $keypro =>  $valuepro): 
														
														// if ($valuepro->name != $dataChitiet->id) {
														// 	continue;
														// }
														// $dataNgaychi = Chingay::findOne($valuepro->chingay_id);
														$spxuat = $dichvu->AllXuatCT($dataPro->idPro,$dataPro->cuahang_id);
														// echo('<pre>');
														// print_r($spxuat);die;
														?>

															
														
														<tr class="">
															<td><?= $keypro+1 ?></td>
															<td><?= Yii::$app->formatter->asDatetime($ngay,"php:d-m-Y") ?></td>
															<?php if ($valuepro['chingay']['day'] == $ngay): ?>
																
															<td><?=$dataPro->quantity ?></td>
															<td><?=$dataPro->quantity*$dataPro->import_price ?></td>
															<?php endif ?>

															<td><?=$valuepro['quantity'] ?></td>
															<td><?=$valuepro['quantity']*$valuepro['money'] ?></td>
															
															<td><?=$valuepro['quantity'] ?></td>
															<td><?=$valuepro['quantity']*$valuepro['money'] ?></td>

														</tr>

														<?php endforeach ;// endforeach ?>
												</tbody>
												<thead>
													<tr>
														<th colspan ="3" width="20%">Mã sản phẩm : <?= $dataPro->idPro?></th>
														<th>Tồn đầu kỳ : <?= $dataPro->quantity?></th>
														<th colspan="2">Thành tiền : <?=  $dataPro->quantity*$dataPro->import_price ?></th>
														<th colspan="2">Cửa hàng: <?= $dataCuahang[$dataPro->cuahang_id] ?></th>
													</tr>
													<tr>
														<th rowspan="2" class="text-center">STT</th>
														<th rowspan="2" class="text-center">Ngày</th>
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
													</tr>
												</thead>
											</table>

										</div>
									</div>
				</div>
			</div>
		</div>
	</div>
</div>