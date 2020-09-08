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
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
$this->title = 'Thống kê sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
$product = new Product();
$cate = new ProductCate();

?>

<div class="row formsearch">
	<div class="chingay-search col-md-12">
            <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'action' => ['index'],
        // 'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

        <?= $form->field($searchModel, 'cuahang_id',['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => $cuahang,
        'options' => ['placeholder' => 'Enter birth date ...'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?> 
        <?= $form->field($searchModel, 'cate_id',['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => $dataCate,
        'options' => ['placeholder' => 'Enter birth date ...'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
     
        <?= $form->field($searchModel, 'sort',['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => ['SORT_ASC'=>'Tăng dần','SORT_DESC'=>'Giảm dần'],
        'options' => ['placeholder' => 'Enter birth date ...'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>



    <div class="form-group" style="padding-top: 18px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary button_luu']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success button_luu']) ?>
        <?= Html::button('In danh sách', ['class' => 'btn btn-info button_luu','onclick'=>'window.print();']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
</div>
<div class="inhoadon">




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
