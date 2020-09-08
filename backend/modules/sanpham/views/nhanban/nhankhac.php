<?php 
	$this->title = 'Thống kê sản phẩm';
	$this->params['breadcrumbs'][] = $this->title;
 ?>
 <br>
 <br>
 <br>
<div class="row formsearch">
	<?php  echo $this->render('_nhanban', ['model' => $searchModel,'data' => $data]); ?>
</div>