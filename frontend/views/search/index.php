<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\widgets\cateNewsRightWidget;
use frontend\widgets\newsTabsWidget;
?>
<div class="col-md-8 search image_slider">
	<div class="col-md-11 col-md-offset-1">
		<?php $form = ActiveForm::begin([
			// 'action'  => ["index"],
			// 'action'  => Url::to('index'),
			'method'  => 'get',
			'options' => ['class' => 'form-inline'],
		]);?>
		<label>Tìm kiếm của bạn : </label>

		<div class="input-group col-md-10" style="margin: 15px 0">

			<?= Html::textInput('key_search', ($keySearch!='')?$keySearch: "", ['class' => 'textSearch form-control',"placeholder"=>" Tìm kiếm ","style"=>"width:80%"]) ?>
			<?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-default',"style"=>"width:10%"]) ?>

		</div>
		<?php ActiveForm::end();?>
	</div>
	<div class="clearfix"></div>

	<div class="result_search">
		<?php if ($keySearch!=''): ?>
			<h3>Kết quả tìm kiếm của bạn với từ khóa : <strong>"<?= $keySearch ?>"</strong></h3>

			<?php else: ?>
				<h3><i>Bạn chưa nhập từ khóa tìm kiếm, hãy nhập từ khóa bên trên</i></h3>
			<?php endif ?>
			<section id="news-new">
				<?php foreach ($data as $keynew => $valuenew):
					$image = str_replace('uploads', 'tin-tuc', $valuenew['nimage']);
					$file_image = Yii::getAlias('@uploading').'/'.$image;

					if (!file_exists($file_image) || $valuenew['nimage'] =='' || $valuenew['nimage'] =='') {
						$image = 'tin-tuc/no_image.png';
					}
          // dbg($image);
					?>
					<div class="media">
						<div class="media-body"><h4 class="media-heading"><a href="<?= Yii::$app->homeUrl.$valuenew['nslug'] ?>.html"><?= $valuenew['name'] ?></a></h4></div>
						<a class="pull-left" href="<?= Yii::$app->homeUrl.$valuenew['nslug'] ?>.html">
							<img class="lazy_image" data-src="<?= Yii::$app->homeUrl.$image ?>"  width="130px">
						</a>
						<p><?= $valuenew['nshort_description'] ?></p>

					</div>
				<?php endforeach ?>
			</section>
		</div>
	</div>
<div class="col-md-4 col-sm-12 col-xs-12 Search" id="sidebar">
	<?= newsTabsWidget::widget() ?>
	<?= cateNewsRightWidget::widget() ?>
</div>
