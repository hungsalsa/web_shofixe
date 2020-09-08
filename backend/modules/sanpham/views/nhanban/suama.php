<?php 
use yii\helpers\Html;
	$this->title = 'Sửa mã sản phẩm và dịch vụ, Khoản chi';
	$this->params['breadcrumbs'][] = $this->title;
 ?>
 <br>
 <br>
 <h1><?= Html::encode($this->title) ?></h1>
 <br>
<div class="row formsearch">
	<?php  echo $this->render('_searchsua', ['model' => $searchModel]); ?>
</div>



<div class="card">
  <div class="card-header bg-info">
<ul class="list-group list-group-flush">
    <li class="list-group-item bg-success text-center text-uppercase" style="font-weight: bold;">danh sách tìm kiếm</li>
  </ul>

  </div>
  <ul class="list-group list-group-flush">
  	<?php if (!empty($data['products'])): ?>
  		<?php foreach ($data['products'] as $value): ?>
  			<div class="card pull-left col-md-4" >
  				<ul class="list-group">
  					<li class="list-group-item text-info">Sản phẩm cửa hàng : <span class="btn btn-success btn-outline text-uppercase"><?= $value->cuahang->name ?></span></li>
  					<li class="list-group-item">Mã sản phẩm : <span class="text-info"><?= $value->idPro ?></span></li>
  					<li class="list-group-item">Tên sản phẩm : <span class="text-info"><?= $value->proName ?></span></li>
  				</ul>
  			</div>
  		<?php endforeach ?>
	<?php endif ?>
  		<?php if (!empty($data['services'])): ?>
      <div class="card pull-left col-md-6">
        <ul class="list-group">
          <li class="list-group-item active">Dịch vụ </li>
          <li class="list-group-item">Mã dịch vụ : <span class="text-info"><?= $data['services']->madichvu ?></span></li>
          <li class="list-group-item">Tên dịch vụ : <span class="text-info"><?= $data['services']->tendv ?></span></li>
        </ul>
      </div>
      <?php endif ?>

      <?php if (!empty($data['khoanchi'])): ?>
  		<div class="card pull-left col-md-6">
  			<ul class="list-group">
  				<li class="list-group-item active">Khoản chi</li>
  				<li class="list-group-item"> Mã dịch vụ : <span class="text-info"><?= $data['khoanchi']->makhoanchi ?></span></li>
  				<li class="list-group-item"> Tên dịch vụ : <span class="text-info"><?= $data['khoanchi']->name ?></span></li>
  			</ul>
  		</div>
  		<?php endif ?>
	<?php if (empty($data['services']) && empty($data['khoanchi']) && empty($data['products']) && Yii::$app->request->post()): ?>
		<div class="card pull-left col-md-12">
  			<ul class="list-group">
  				<li class="list-group-item active">Không tìm thấy </li>
  			</ul>
  		</div>
  	<?php endif ?>
	<?php if (isset($data['error'])): ?>
		<div class="card pull-left col-md-12">
  			<ul class="list-group">
  				<li class="list-group-item bg-danger text-center"><?= $data['error'] ?></li>
  			</ul>
  		</div>
  	<?php endif ?>
  </ul>
</div>