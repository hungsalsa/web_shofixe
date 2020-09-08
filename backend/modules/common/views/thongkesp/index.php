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
    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['searchModel' => $searchModel,'search'=>$search,'dataProduct'=>$dataProduct]); ?>
    <?php Pjax::end(); ?>
</div>
<br>
<!-- <pre> -->
<?php 
echo count($data);
// print_r($data);
 ?>
 <?php foreach ($search['cuahang_query'] as $keyCH => $cuahang): ?>
 	
<div class="white-box">
	<h2 class="box-title text-center" style="font-size: 32px;"><?= $cuahang ?></h2>
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
					<?php if ($value['cuahang_id'] != $keyCH){continue;} ?>
				<tr>
					<td><?= $value['id'] ?></td>
					<td><?= $value['masp'] ?></td>
					<td><?= $value['proName'] ?></td>
					<td><?= $value['tencuahang'] ?></td>
					<td><?= $value['cateName'] ?></td>
					<td><?= $value['sldauky'] ?></td>
					<td><?= $value['tiendauky'] ?></td>
					<td><?= $value['slnhap'] ?></td>
					<td><?= $value['tiennhap'] ?></td>
					<td><?= $value['slnhapnb'] ?></td>
					<td><?= $value['slxuat'] ?></td>
					<td><?= $value['tienxuat'] ?></td>
					<td><?= $value['slxuatnb'] ?></td>
				</tr>
				
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php endforeach ?>
<?php
// echo count($data);
// echo '<pre>';print_r($data);
// die;