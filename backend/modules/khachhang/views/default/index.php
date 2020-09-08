<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\Employee;
use backend\modules\doanhthu\models\CuaHang;
use backend\modules\chi\models\Chingay;
use backend\modules\khachhang\models\Docso;


$this->title = 'Chi tiết dịch vụ ';
$this->params['breadcrumbs'][] = $this->title;
$chi = new Chingay();
?>
<div class="row formsearch clearfix">
	<?php  echo $this->render('_search', ['model' => $searchModel,'dataKhachhang'=>$dataKhachhang]); ?>
</div>
<div class="inhoadon">
<?php 
$formatter = \Yii::$app->formatter;
if (!empty($data)): 
$docchu = new Docso();

         //    echo $docchu->docsotien(1256500);die;
	// $employee = new Employee();
	// $khachhang = $data['khachhang'];
	// $dichvu = $data['dichvu'];
	// $cuahang = new CuaHang();

	// echo '<pre>';print_r($data);
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
				<div style="width: 30%">
					<table class="mototech">
						<tr> <td><img src="http://local.yii168.vn/uploads/logo.png"></td> </tr>
						<tr> <td>CS1: 167 Kim Ngưu</td> </tr>
						<tr> <td>CS2: 257 Trung Văn</td> </tr>
						<tr> <td>CS3: 212 Định Công Thượng</td> </tr>
						<tr> <td>CS4: 11 Ngõ 381 Nguyễn Khang</td> </tr>
						<tr> <td>CS5: 173 Tam Trinh</td> </tr>
					</table>
				</div>
				<div  style="width: 70%" class="pull-right">
					<h2 class="text-center text-uppercase">phiếu thanh toán kiêm bảo hành</h2>
					<table class="khachhang info">
						<tr>
							<td>Khách hàng: <span class="font-bold"><?= $data['khachhang']['name'] ?></span> </td>
							<td>SĐT : <span class="font-bold"><?= $data['khachhang']['phone'] ?></span></td>
						</tr>
						<tr>
							<td>Xe : <span class="font-bold"><?= $data['xesua']['xe'] ?></span> </td>
							<td>Biển số : <span class="font-bold"><?= $data['xesua']['bks'] ?></span></td>
						</tr>
						<tr><td colspan="2"></td></tr>
						<tr>
							<td colspan="2" class="text-center">Website: https://mototech.com.vn</td>
						</tr>
					</table>
				</div>
				<!-- ====================== START ROW ===================== -->
				</div>
				<div class="row">
					<h4 class="text-center col-md-12 mt-5">Điện thoại: 024.668.47600/ Hotline: 0984.557.937 - 0965.800.500 / Cứu hộ khẩn cấp: 0982.618.518 </h4>
					<table style="width: 100%" class="table table-hover">
						<thead>
							<tr>
								<th>STT</th>
								<th>Sửa chữa - bảo dưỡng </th>
								<th width="10%" class="pl-5">Giá </th>
								<th width="7%">Số lượng</th>
								<th width="10%" class="pl-5">Thành tiền </th>
								<th width="10%">Bảo hành</th>
							</tr>
						</thead>
						<tbody>
							
							<?php $tongtien = 0; 
								// $chitietdv = $value->day;
								// echo $value->day;
								$chitietdv = $data['chitietdv'];
								// print_r($chitietdv);
								// die;
								foreach ($chitietdv as $key => $chitiet):
									$tongtien += $chitiet->quantity*$chitiet->price;
							?>
								
							<tr data-index="0">
								<td><?= $key + 1 ?></td>
								<td><?= ltrim($listDichvu[$chitiet->id_Pro_dv],'--') ?></td>
								<td class="text-right" style="padding-right: 35px"><?=  Yii::$app->formatter->asDecimal($chitiet->price*1000,0); ?></td>
								<td><?= $chitiet->quantity ?></td>
								<td class="text-right" style="padding-right: 35px"><?= Yii::$app->formatter->asDecimal($chitiet->quantity*$chitiet->price*1000,0) ?></td>
								<td>6 tháng</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4" class="font-bold">Tổng tiền </td>
								<td class="text-right font-bold" style="padding-right: 35px"><?= Yii::$app->formatter->asDecimal($tongtien*1000,0) ?></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="6" class="font-bold">Bằng chữ : <span class="ml-5"><?= ucfirst($docchu->docsotien($tongtien*1000)) ?> </span></td>
							</tr>
							<tr>
								<td colspan="6" class="p-4">Tồn tại của xe</td>
							</tr>
							<tr>
								<td colspan="6" class="p-4"><?= $data['khachhang']['note'] ?></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>

	</div>
<?php else: ?>
	<?php if ($_POST): ?>
		<h1>Khách hàng bạn chọn không có dịch vụ nào</h1>
		
	<?php endif ?>
	
<?php endif ?>
</div>
	<!-- ============================================================== -->
	<!-- End Info box -->
	<!-- ============================================================== -->

<?php $this->registerCss("
	table.khachhang.info td {
		padding: 8px 80px;
		font-size: 16px;
	}
	table.mototech td {
		padding: 2px;
		font-size: 14px;
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
			
		}
");
?>

<!-- td{
border: 1px solid black;
}
.table{
border-collapse: collapse;
empty-cells: show;
} -->