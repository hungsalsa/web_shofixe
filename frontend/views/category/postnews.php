<?php
$this->title = 'Tin tức mới nhất';
use frontend\widgets\sidebarRecentPostWidget;
?>
<div class="container-fluid no-left-padding no-right-padding author-post tab-content">
      <!-- Popular Video -->
      <div class="container">
            <div class="row">
                  
                  <!-- Content Area -->
                  <div class="col-md-8 col-sm-6 col-xs-12 no-left-padding no-right-padding content-area">
                        <?php foreach ($dataNew as $keyn => $new): $images = str_replace('uploads', 'anh', $new['images'])?>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                              <!-- Type Post -->
                              <div class="type-post color-1">
                                    <div class="entry-cover"><a href="#"><img data-src="<?= Yii::$app->homeUrl.$images ?>" alt="<?= $new['htmltitle'] ?>" class="lazyloadImg"></a></div>
                                    <div class="entry-content">
                                          <div class="post-format"><i class="fa fa-play"></i></div>
                                          <!-- <div class="post-category"><a href="#" title="business">business</a></div> -->
                                          <h3 class="entry-title"><a href="<?= Yii::$app->homeUrl.$new['link'] ?>.html"><?= $new['name'] ?></a></h3>
                                          <p class="short_description"><?= $new['short_description'] ?></p>
                                          <div class="entry-footer">
                                                <span class="post-date"><a href="#">02 July, 2016</a></span>
                                                <span class="post-like"><i class="fa fa-heart-o"></i><a href="#">320</a></span>
                                                <span class="post-view"><i class="fa fa-eye"></i><a href="#">2350</a></span>
                                          </div>
                                          <a href="<?= Yii::$app->homeUrl.$new['link'] ?>.html" title="WATCH NOW">Chi tiết <i class="fa fa-angle-right"></i></a>
                                    </div>
                              </div><!-- Type Post /- -->
                        </div>
                        <?php endforeach ?>
                  </div><!-- Content Area /- -->
                  <!-- Widget Area -->
                  <div class="col-md-4 col-sm-6 col-xs-12 widget-area">
                        <!-- Widget Recent Post -->
                        <?= sidebarRecentPostWidget::widget() ?>
                        <!-- <aside class="widget widget_latestposts">
                              <h3 class="widget-title">Recent Posts</h3>
                              <div class="latest-content-box">
                                    <div class="latest-content color-5">
                                          <a href="#" title="Recent Posts"><i><img src="<?= Yii::$app->homeUrl ?>vender/images/wd-rcnt-1.jpg" class="wp-post-image" alt="blog-1"></i></a>
                                          <span><a href="#" title="POLITICS">POLITICS</a> <a href="#">22 OCT 2014</a></span>
                                          <h5><a title="Qaim says prominent people arrested" href="#">Qaim says prominent people arrested </a></h5>
                                    </div>
                                    <div class="latest-content color-2">
                                          <a href="#" title="Recent Posts"><i><img src="<?= Yii::$app->homeUrl ?>vender/images/wd-rcnt-2.jpg" class="wp-post-image" alt="blog-1"></i></a>
                                          <span><a href="#" title="SPORTS">SPORTS</a> <a href="#">22 OCT 2014</a></span>
                                          <h5><a title="Way now cleared for Australian" href="#">Way now cleared for Australian </a></h5>
                                    </div>
                                    <div class="latest-content color-3">
                                          <a href="#" title="Recent Posts"><i><img src="<?= Yii::$app->homeUrl ?>vender/images/wd-rcnt-3.jpg" class="wp-post-image" alt="blog-3"></i></a>
                                          <span><a href="#" title="BUSINESS">BUSINESS</a> <a href="#">22 OCT 2014</a></span>
                                          <h5><a title="EU exit would leave Britain with zero" href="#">EU exit would leave Britain with zero</a></h5>
                                    </div>
                              </div>
                              <div class="see-more"><a href="#" title="SEE MORE POST">SEE MORE POST</a></div>
                        </aside> -->
                        <!-- Widget Recent Post -->
                        <!-- Popular Video -->
                        <!-- <aside class="widget widget_video">
                              <h3 class="widget-title">POPULAR VIDEOS</h3>
                              <div class="video-block">
                                    <div class="video-post">
                                          <a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video1.jpg" alt="Popular Video"></a>
                                          <h5><a href="#"><i class="fa fa-play"></i>Qaim says prominent people arrested </a></h5>
                                    </div>
                                    <div class="video-post">
                                          <a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video2.jpg" alt="Popular Video"></a>
                                          <h5><a href="#"><i class="fa fa-play"></i>Way now cleared for Australian </a></h5>
                                    </div>
                                    <div class="video-post">
                                          <a href="#"><img src="<?= Yii::$app->homeUrl ?>vender/images/popular-video3.jpg" alt="Popular Video"></a>
                                          <h5><a href="#"><i class="fa fa-play"></i>Way now cleared for Australian </a></h5>
                                    </div>
                              </div>
                              <div class="see-more"><a href="#" title="SEE MORE Video">SEE MORE Video</a></div>
                        </aside> -->
                        <!-- Popular Video /- -->
                  </div><!-- Widget Area /- -->
            </div>
      </div><!-- Container /- -->                           
      <!-- Popular Video -->
</div>