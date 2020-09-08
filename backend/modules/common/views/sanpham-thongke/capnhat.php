<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\common\models\SanphamThongkeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sanpham Thongkes';
$this->params['breadcrumbs'][] = $this->title;

// echo count($data);
// echo '<pre>';print_r($data);
// die;

?>
<div class="sanpham-thongke-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
</div>
<br>
<!-- <pre> -->
<?php 
echo count($data);
// print_r($data);
 ?>
<div class="white-box">
	<div class="table-responsive">
		<table class="table color-table success-table">
			<thead>
				<tr>
					<th>id</th>
					<th>idPro</th>
					<th>proName</th>
					<th>cuahang_id</th>
					<th>cate_id</th>
					<th>SL ĐK</th>
					<th>Tiền ĐK</th>
					<th>SL Nhập TK</th>
					<th>Tiền Nhập TK</th>
					<th>SL Nhập NB</th>
					<th>SL Xuất TK</th>
					<th>Tiền Xuất TK</th>
					<th>SL Xuất NB</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $value): ?>
					
				<tr>
					<td><?= $value['id'] ?></td>
					<td><?= $value['idPro'] ?></td>
					<td><?= $value['proName'] ?></td>
					<td><?= $value['cuahang_id'] ?></td>
					<td><?= $value['cate_id'] ?></td>
					<td><?= $value['sldauky'] ?></td>
					<td><?= $value['tiendk'] ?></td>
					<td><?= $value['tongslnhap'] ?></td>
					<td><?= $value['tongtiennhap'] ?></td>
					<td><?= $value['tongslNhapNB'] ?></td>
					<td><?= $value['tongslKH'] ?></td>
					<td><?= $value['tongtienKH'] ?></td>
					<td><?= $value['tongslXuatNB'] ?></td>
				</tr>
				
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php
// echo count($data);
// echo '<pre>';print_r($data);
// die;