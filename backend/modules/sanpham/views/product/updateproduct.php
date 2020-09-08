<?php 
use yii\helpers\Html;

$this->title = 'Chọn cửa hàng bạn muốn cập nhật và nhân bản sản phẩm dịch vụ';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
<br>

<div class="col-md-7 col-md-offset-2">
	<?= Html::a('167 Kim Ngưu', ['updateproduct'], [
	'class' => 'btn btn-primary',
	'data' => [
		'confirm' => 'Bạn có chắc muốn nhân bản tất cả các sản phẩm sang cửa hàng bạn quản lý?',
		'method' => 'post',
		'params' => ['cuahang_id' => 1]
	],
	]) ?>
	<?= Html::a('212 Định Công Thượng', ['updateproduct'], [
	'class' => 'btn btn-success col-md-offset-1',
	'data' => [
		'confirm' => 'Bạn có chắc muốn nhân bản tất cả các sản phẩm sang cửa hàng bạn quản lý?',
		'method' => 'post',
		'params' => ['cuahang_id' => 3]
	],
	]) ?>
	<?= Html::a('257 Trung Văn', ['updateproduct'], [
	'class' => 'btn btn-primary col-md-offset-1',
	'data' => [
		'confirm' => 'Bạn có chắc muốn nhân bản tất cả các sản phẩm sang cửa hàng bạn quản lý?',
		'method' => 'post',
		'params' => ['cuahang_id' => 4]
	],
	]) ?>
	<?= Html::a('Nguyễn Khang', ['updateproduct'], [
	'class' => 'btn btn-success col-md-offset-1',
	'data' => [
		'confirm' => 'Bạn có chắc muốn nhân bản tất cả các sản phẩm sang cửa hàng bạn quản lý?',
		'method' => 'post',
		'params' => ['cuahang_id' => 5]
	],
	]) ?>
</div>
</div>