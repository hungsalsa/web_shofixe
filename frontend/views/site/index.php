<?php
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
use frontend\widgets\newsTopWidget;
use frontend\widgets\newsTabsWidget;
use frontend\widgets\cateNewsWidget;
use frontend\widgets\cateNewsRightWidget;
?>
<div class="col-md-8" id="content">
	<!-- newsTopWidget -->
	<?= newsTopWidget::widget() ?>
	<!-- cateNewsWidget -->
	<?= cateNewsWidget::widget() ?>
	
</div>
<div class="col-md-4" id="sidebar">
	<!-- newsTabsWidget -->
	<?= newsTabsWidget::widget() ?>
	<!-- cateNewsRightWidget -->
	<?= cateNewsRightWidget::widget() ?>
	
</div>
