<?php
$this->title = $dataCate->title;
use frontend\widgets\sidebarRecentPostWidget;
?>
<div class="container-fluid no-left-padding no-right-padding latest-video-block">

	<?php if (!empty($dataCate)): ?>
		<!-- Container -->
		<!-- <div class="container"> -->
			<div class="row">
				
				<!-- Section Header -->
      <?php $parent = $dataCate->parent; ?>
      <div class="section-header" style="margin-top: 20px">
      		<nav aria-label="breadcrumb">
      			<ol class="breadcrumb  col-md-6">
      				<li class="breadcrumb-item"><a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a></li>
      				<li class="breadcrumb-item active" aria-current="page"><a href="<?= Yii::$app->homeUrl.$dataCate->slug ?>-c.html"><?= $dataCate->cateName ?></a></li>
      			</ol>
      			<ol class="breadcrumb text-right col-md-6">
      				<?php if (!empty($parent)):  foreach ($parent as $parent): ?>
      					<li class="breadcrumb-item" aria-current="page"><a href="<?= Yii::$app->homeUrl.$parent->slug ?>-c.html"><?= $parent->cateName ?></a></li>
      				<?php endforeach;endif ?>
      			</ol>
      		</nav>
      		<a class="text-title" href="<?= Yii::$app->homeUrl.$dataCate->slug.'-c'?>.html"><?= $dataCate->cateName ?></a>
      	</div><!-- Section Header /- -->
      	
      <div class="col-md-8 col-sm-6 col-xs-6 content-area">
      	<h1><?= $dataCate->cateName ?></h1>
      	<?php if (!empty($dataNew)): ?>
      		<div class="row">
      			<div id="latest_video_block">
      			<?php foreach ($dataNew as $keyn => $new): ?>
      				<div class="col-xs-12">
      					<!-- Type Post -->
      					<div class="type-post format-video color-1">
      						<div class="entry-cover"><a href="#"><img src="<?= Yii::$app->homeUrl.$new->images ?>" alt="Post" /></a></div>
      						<div class="entry-content">
      							<div class="post-category"><a href="#" title="Technology">Technology</a></div>
      							<h3 class="entry-title"><a href="<?= Yii::$app->homeUrl.$new->link ?>.html"><?= $new->name ?></a></h3>
      							<p class="short_description"><?= $new->short_description ?></p>
      							<div class="entry-footer">
      								<span class="post-date"><a href="#">15 Augest, 2016</a></span>
      								<span class="post-like"><i class="fa fa-heart-o"></i><a href="#">127</a></span>
      								<span class="post-view"><i class="fa fa-eye"></i><a href="#">756</a></span>
      							</div>
      							<a href="<?= Yii::$app->homeUrl.$new->link ?>.html" title="WATCH NOW">Read More <i class="fa fa-angle-right"></i></a>
      						</div>
      					</div><!-- Type Post /- -->

      					<!-- Type Post -->
      					<!-- <div class="type-post format-video color-4">
      						<div class="entry-cover"><a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/latest-video-5.jpg" alt="Post" /></a></div>
      						<div class="entry-content">
      							<div class="post-format"><i class="fa fa-play"></i></div>
      							<div class="post-category"><a href="#" title="cricket">cricket</a></div>
      							<h3 class="entry-title"><a href="#">Grand Canyon Considers Changes to Back country</a></h3>
      							<p>Reporter is one of the excellent magazine in the world.Newshub magazine reached many readers very soon.</p>
      							<div class="entry-footer">
      								<span class="post-date"><a href="#">13 November, 2016</a></span>
      								<span class="post-like"><i class="fa fa-heart-o"></i><a href="#">651</a></span>
      								<span class="post-view"><i class="fa fa-eye"></i><a href="#">253</a></span>
      							</div>
      							<a href="#" title="WATCH NOW">WATCH NOW <i class="fa fa-play"></i></a>
      						</div>
      					</div>Type Post /- -->
      				</div>
      				
      			<?php endforeach?>
      		</div>
      		</div><!-- Row /- -->
      	<?php  endif  ?>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-6 widget-area">
            <!-- Widget Recent Post -->
            <?= sidebarRecentPostWidget::widget() ?>
      	
      	<!-- Popular Video -->
      	<aside class="widget widget_video">
      		<h3 class="widget-title">POPULAR VIDEOS</h3>
      		<div class="video-block">
      			<div class="video-post">
      				<a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video1.jpg" alt="Popular Video" /></a>
      				<h5><a href="#"><i class="fa fa-play"></i>Qaim says prominent people arrested </a></h5>
      			</div>
      			<div class="video-post">
      				<a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video2.jpg" alt="Popular Video" /></a>
      				<h5><a href="#"><i class="fa fa-play"></i>Way now cleared for Australian </a></h5>
      			</div>
      			<div class="video-post">
      				<a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video3.jpg" alt="Popular Video" /></a>
      				<h5><a href="#"><i class="fa fa-play"></i>Way now cleared for Australian </a></h5>
      			</div>
      		</div>
      		<div class="see-more"><a href="#" title="SEE MORE Video">SEE MORE Video</a></div>
      	</aside><!-- Popular Video /- -->

      	<!-- Facebook fanpage -->
      	<aside class="widget widget_video">
      		<h3 class="widget-title">FANPAGE </h3>
      		<div class="video-block">
      			<div class="fb-page" data-href="https://www.facebook.com/suachuaxemaymototech/" data-tabs="timeline" data-height="280" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/suachuaxemaymototech/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/suachuaxemaymototech/">Sửa chữa bảo dưỡng xe máy MotoTech</a></blockquote></div>
      		</div>
      	</aside><!-- Facebook fanpage /- -->

      </div>

  </div>
  <!-- </div> -->
  <!-- Widget Area -->

<?php endif ?>
</div>
