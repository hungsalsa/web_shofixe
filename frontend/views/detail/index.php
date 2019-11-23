<?php
$this->title = $data->seo_title;
use frontend\widgets\newsTabsWidget;
use frontend\widgets\cateNewsRightWidget;
Yii::$app->params['og_title']['content'] = $data->seo_title;
Yii::$app->params['og_description']['content'] = $data->seo_descriptions;
Yii::$app->params['og_url']['content'] = Yii::$app->homeUrl.$data->seo_descriptions;
Yii::$app->params['og_image']['content'] = Yii::$app->request->hostinfo.'/'.$data->images;

// dbg(Yii::$app->request->hostinfo.'/'.$data->images);
?>
<!-- Single Post -->
<div class="container-fluid no-left-padding no-right-padding">
	<!-- Container -->
	<div class="row">
		<div class="container slide-text">
			<div class="row">
				<?php //dbg($dataCate) ?>
				<ul class="breadcrumb pull-left">
					<?php if (count($dataCate)==1): ?>
						<li class="bder-l3">
							<h4><a href="<?= Yii::$app->homeUrl.$dataCate['main']['slug'] ?>" title="Kinh doanh"><?= $dataCate['main']['cateName'] ?></a></h4>
						</li>
						<?php else: ?>
							
							<li class="start">
								<h4><a href="<?= Yii::$app->homeUrl.$dataCate['parent']['slug'] ?>" title="Kinh doanh"><?= $dataCate['parent']['cateName'] ?></a></h4>
							</li>
							<li>
								<h4><a href="<?= Yii::$app->homeUrl.$dataCate['main']['slug'] ?>"><?= $dataCate['main']['cateName'] ?></a></h4>
							</li> 
						<?php endif ?>
					</ul>
				</div>
			</div>
	</div>
	<div class="row">


		<!-- Content Area -->
		<div class="col-md-8 col-sm-12 col-xs-12 content-area">
			<article class="type-post color-3">
				<header class="clearfix">

					<div class="block_share right">
						<a class="item_fb btn_facebook" rel="nofollow" href="javascript:;" title="Chia sẻ bài viết lên facebook"><i class="ic ic-facebook"></i></a>
						<a class="item_twit btn_twitter" rel="nofollow" href="javascript:;" id="twitter" data-url="http://bit.ly/2QgMaZK" title="Chia sẻ bài viết lên twitter"><i class="ic ic-twitter"></i></a>
						<a class="btn_print" href="javascript:;" onclick="common.printPopup();" title="Print" rel="nofollow"><i class="ic ic-print"></i></a>
						<a class="btn_email login_5 open-popup-link" rel="nofollow" href="#email-popup" id="email_content" title="Email" data-component-runtime="js" data-component-function="initMail" data-component-input="{}"><i class="ic ic-email"></i></a>
					</div>
				</header>
				<h1 class="entry-title"><?= $data->name ?></h1>
					<!-- <div class="entry-cover">
						<h1 class="entry-title"><?= $data->name ?></h1>
						<img src="<?= Yii::$app->homeUrl.$data->images ?>" alt="Post" />
						<div class="entry-header">
							<div class="post-category"><a href="#" title="Business">Business</a></div>
							<h3 class="entry-title"><?= $data->name ?></h3>
							<div class="entry-footer">
								<span class="post-date"><a href="#">08 July, 2016</a></span>
								<span class="post-like"><i class="fa fa-heart-o"></i><a href="#">356</a></span>
								<span class="post-view"><i class="fa fa-eye"></i><a href="#">589</a></span>
							</div>
						</div>
					</div> -->
					<div class="entry-content">
						<?= $data->content ?>
						<p><?php date('d/m/Y',$data->created_at) ?></p>
					</div>
					
					<!-- <div class="col-md-12 about-author-box">
						<div class="fb-like pull-right"data-share="true"data-width="450"data-show-faces="true"></div>
					</div> -->

					<div id="comments" class="comments-area">

						<div class="addthis_native_toolbox"></div>

						<div class="views">Lượt xem : <?= $data['view'] +1 ?></div>

					</div>
					<!-- Comment Area /- -->
					<!-- About Author -->
					<!-- <div class="about-author-box">
						<h3>Thông tin tác giả</h3>
						<div class="author">
							<i><img src="<?= Yii::$app->homeUrl ?>vender/images/author.jpg" alt="Author" /></i>
							<h4>Tommy Walker</h4>
							<ul>
								<li><a href="#" class="fb" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" class="tw" title="Twitter"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" class="go" title="Google"><i class="fa fa-google"></i></a></li>
								<li><a href="#" class="ln" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
							</ul>
							<p>reporter is one of the excellent magazine in the world.Newshub magazine reach many readers are very soon by his unique stories in the magazine.</p>
						</div>
					</div> --><!-- About Author /- -->
				</article>
				<?php if (!empty($dataLienquan)): ?>
					<!-- BÀI VIẾT LIÊN QUAN -->
					<div class="box_category box_cothebanquantam" style="margin-top:10px">
						<div class="title_box_category"><h4>Bạn có thể quan tâm</h4></div>
						<div class="width_common list_news_quantam">
							<?php foreach ($dataLienquan as $value): //dbg($value);?>


								<article class="list_news col-md-3 col-sm-6">
									<div class="thumb_art">
										<a class="thumb thumb_5x3" href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html" title="<?= $value['seo_title'] ?>">
											<img class="lazy_image" data-src="<?= Yii::$app->request->hostinfo.'/'.$value['images'] ?>" alt="<?= $value['seo_title'] ?>">
										</a>
									</div>
									<h3 class="title_news">
										<a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html" title="<?= $value['seo_title'] ?>"><?= $value['name'] ?></a>
									</h3>
								</article>
							<?php endforeach ?>


						</div>
					</div>
					<!-- END : BÀI VIẾT LIÊN QUAN -->
				<?php endif ?>
				<!-- Comment Area -->


				<?php if (!empty($cungchuyenmuc)): ?>
					<!-- START : BÀI VIẾT CÙNG CHUYÊN MỤC -->
					<div class="POSTS_SAME_CATEGORY" id="samecategory">
						<hgroup class="title_box_category">
							<h4><a class="first">Cùng chuyên mục</a></h4>
						</hgroup>

						<div class="wrap_10_items clearfix">
							<ul class="list_title">
								<?php foreach ($cungchuyenmuc as $key => $value): ?>

									<li class="col-md-6"><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><?= $value['name'] ?></a>
										<a class="icon_commend" href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html" style="white-space: nowrap; display: none;"> <span class="txt_num_comment font_icon widget-comment-3928169-1"><i class="ic ic-comment ic-x ic-invert"><span>0</span></i>
										</span>
									</a>
								</li>
								<?php if (($key+1)%2==0): ?>
									<span class="clearfix"></span>
								<?php endif ?>
							<?php endforeach ?>

						</ul>
				        <!-- <ul class="list_title col-md-6">
				            <li><a href="https://vnexpress.net/thoi-su/chi-lao-cong-benh-vien-tra-lai-38-trieu-dong-nhat-duoc-3927975.html">Chị lao công bệnh viện trả lại 38 triệu đồng nhặt được </a>
				                <a class="icon_commend" href="https://vnexpress.net/thoi-su/chi-lao-cong-benh-vien-tra-lai-38-trieu-dong-nhat-duoc-3927975.html#box_comment" style="white-space: nowrap; display: none;"> <span class="txt_num_comment font_icon widget-comment-3927975-1"><i class="ic ic-comment ic-x ic-invert"><span>12</span></i>
				                    </span>
				                </a>
				            </li>
				            <li><a href="https://vnexpress.net/thoi-su/nhieu-lanh-dao-xa-o-ha-tinh-su-dung-bang-gia-3927936.html">Nhiều lãnh đạo xã ở Hà Tĩnh sử dụng bằng giả </a>
				                <a class="icon_commend" href="https://vnexpress.net/thoi-su/nhieu-lanh-dao-xa-o-ha-tinh-su-dung-bang-gia-3927936.html#box_comment" style="white-space: nowrap; display: none;"> <span class="txt_num_comment font_icon widget-comment-3927936-1"><i class="ic ic-comment ic-x ic-invert"><span>19</span></i>
				                    </span>
				                </a>
				            </li>
				            <li><a href="https://vnexpress.net/thoi-su/de-xuat-muc-phat-30-trieu-dong-voi-tai-xe-vi-pham-nong-do-con-3927939.html">Đề xuất mức phạt 30 triệu đồng với tài xế vi phạm nồng độ cồn </a>
				                <a class="icon_commend" href="https://vnexpress.net/thoi-su/de-xuat-muc-phat-30-trieu-dong-voi-tai-xe-vi-pham-nong-do-con-3927939.html#box_comment" style="white-space: nowrap;"> <span class="txt_num_comment font_icon widget-comment-3927939-1"><i class="ic ic-comment ic-x ic-invert"><span>33</span></i>
				                    </span>
				                </a>
				            </li>
				        </ul> -->
				    </div>
				</div>
				<!--END: BÀI VIẾT CÙNG CHUYÊN MỤC -->
			<?php endif ?>

		</div><!-- Content Area /- -->

		<!-- Widget Area -->
		<div class="col-md-4 col-sm-12 col-xs-12 widget-area" id="sidebar">
			<?= newsTabsWidget::widget() ?>
			<?= cateNewsRightWidget::widget() ?>
			<!-- Popular Video -->
				<!-- <aside class="widget widget_video">
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
				</aside> -->
				<!-- Popular Video /- -->

				<!-- Facebook fanpage -->
				<!-- <aside class="widget widget_video">
					<h3 class="widget-title">FANPAGE </h3>
					<div class="video-block">
						<div class="fb-page" data-href="https://www.facebook.com/suachuaxemaymototech/" data-tabs="timeline" data-height="280" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/suachuaxemaymototech/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/suachuaxemaymototech/">Sửa chữa bảo dưỡng xe máy MotoTech</a></blockquote></div>
					</div>
				</aside> -->
				<!-- Facebook fanpage /- -->
			</div><!-- Widget Area /- -->
		</div>
			</div><!-- Single Post /- -->