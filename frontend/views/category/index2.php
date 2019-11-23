<?php
use yii\widgets\LinkPager;
$value = reset($dataCate);
$this->title = $value['seo_title'];
use frontend\widgets\sidebarRecentPostWidget;
use frontend\widgets\cateNewsRightWidget;
use frontend\widgets\newsTabsWidget;
// dbg($value);
?>
<div class="container-fluid no-left-padding no-right-padding author-post tab-content">
  <!-- Popular Video -->
  <div class="container">
    <div class="col-md-8 image_slider">
      <?php if (!empty($dataNew['newHotSlider'])): ?>
      <section id="news-top">
        <!-- <h3 style="font-size: 16px;">Tin nổi bật</h3> -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="col-md-8 image_slider">
            <div class="carousel-inner">
              <?php foreach ($dataNew['newHotSlider'] as $key => $value): //dbg($value); ?>
                <div class="item <?= ($key==0)? "active":"" ?>">
                  <a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html">
                    <img class="lazy_image" data-src="<?= Yii::$app->homeUrl.$value['images'] ?>" title="<?= $value['seo_title'] ?>">
                  </a>
                  <div class="carousel-caption">
                    <h4><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><?= $value['name'] ?></a></h4> 
                    <p><?= $value['short_description'] ?></p>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
          </div>
          <div class="col-md-4 list_slider">
            <ul class="list-group"> 
              <?php foreach ($dataNew['newHotSlider'] as $key => $value): ?>
                <li data-target="#myCarousel" data-slide-to="<?= $key ?>" class="list-group-item <?= ($key==0)? "active":"" ?>"> 
                  <a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><?= $value['name'] ?></a>
                </li> 
              <?php endforeach ?>
            </ul>
          </div>
        </div>
      </section>
      <?php endif ?>
      <section id="news-new">
        <?php foreach ($dataNew['news'] as $keynew => $valuenew): 
         $image = str_replace('uploads', 'tin-tuc', $valuenew['images'])?>
         <div class="media">
          <div class="media-body"><h4 class="media-heading"><a href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html"><?= $valuenew['name'] ?></a></h4></div>
          <a class="pull-left" href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html">
            <img class="media-object lazy_image" data-src="<?= Yii::$app->homeUrl.$image ?>" alt="<?= $valuenew['seo_title'] ?>" width="130px">
          </a>
          <p><?= $valuenew['short_description'] ?></p>
          
        </div>
      <?php endforeach ?>
    </section>
    <section class="pull-right mr-5">
    <?php 
    if ($dataNew['pages']->pageCount  > 1) {
      
      echo LinkPager::widget([
        'pagination' => $dataNew['pages'],
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last',
        'prevPageLabel' => '<i class="fas fa-chevron-left"></i>',
        'nextPageLabel' => '<i class="fas fa-chevron-right"></i>',
        'maxButtonCount' => 4,
        // 'linkContainerOptions'=>['slug']
      ]);
    }
    ?>
     </section>
  </div>
  <div class="col-md-4 col-sm-12 col-xs-12 widget-area">
    <?= newsTabsWidget::widget() ?>
    <?= cateNewsRightWidget::widget() ?>
  </div>
</div><!-- Container /- -->                           
<!-- Popular Video -->
</div>

<!-- $pagination = [
    'pageSize' => 1,
    'forcePageParam' => true,
    'pageSizeParam' => false,
    'params' => [
        'page' => $this->page,                        
        'job' => $this->job_id,
        'order-price' => $this->min_price,
        'order-exp' => $this->experience
    ],
]; -->