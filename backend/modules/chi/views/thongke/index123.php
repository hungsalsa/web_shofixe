<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChingaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use backend\modules\chi\models\Chingay;
$this->title = 'Danh sách các khoản chi theo ngày';
$this->params['breadcrumbs'][] = $this->title;

$chi = new Chingay();

// echo '<pre>';print_r($data);die;
?>
<?php  echo $this->render('_search', ['model' => $model,'dataCuahang'=>$data['cuahangs']]); ?>
<div class="inhoadon row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title text-center">Các khoản chi bạn quản lý</h5>

				<!-- ====================== START ROW ===================== -->
				<div class="col-md-12 col-lg-12 col-xlg-12">

					<?php foreach ($data['cuahang_query'] as $keycuahang => $cuahang): ?>
						<h4 class="card-title text-center"><?= $cuahang ?></h4>
						<div class="card-columns">

							<?php foreach ($data['loaichi'] as $keychi => $valuechi): $total = 0; ?>

								
								<div class="card p-2">
									<div class="card-body">
										<h4 class="card-title"><?= $valuechi  ?></h4>
										<div class="table fixed-table-body">


											<table class="table">
												<?php foreach ($datachi as  $value): 
													if ( $value->cuahang_id != $keycuahang) {
														continue;
													}
													$chitietchi = $value->chitiet;
													
													?>
													<tbody>

														<?php foreach ($chitietchi as $key => $chitiet): 
															if ($chitiet['name'] != $keychi) {
																continue;
															}

															$total += $chitiet['money']*$chitiet['money']; ?>
															<tr class="">
																<td><?= $key+1 ?></td>
																<td><?= Yii::$app->formatter->asDatetime($value->day,"php:d-m-Y") ?></td>
																<td><?= $chitiet['name'] ?></td>
																<td><?=  Yii::$app->formatter->asDecimal($chitiet['money'],0) ?></td>
																<td><?= $data['nhanvien'][$chitiet['employee_id']] ?></td>
															</tr>
														<?php endforeach ?>
													</tbody>
												<?php endforeach ?>
												
												<thead>
													<tr>
														<th>STT</th>
														<th>Ngày chi</th>
														<th>Tên khoản chi</th>
														<th>Số tiền </th>
														<th>Người chi </th>
													</tr>
												</thead>
											</table>

				

			</div>
			<h4 class="card-title pull-right text-danger"> Tổng tiền : <?= Yii::$app->formatter->asDecimal($total,0) ?></h4>
		</div>
	</div>
	
	<?php endforeach ?>


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
	<!-- ============================================================== --

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
