<?php
use yii\widgets\LinkPager;
$this->title = $seo_title;
use frontend\widgets\sidebarRecentPostWidget;
use frontend\widgets\cateNewsRightWidget;
use frontend\widgets\newsTabsWidget;
// dbg($value);
?>
<div class="container-fluid no-left-padding no-right-padding author-post tab-content">
  <div class="row">
    <div class="container slide-text">
      <div class="row">
        <?php //dbg($dataCate) ?>
        <ul class="breadcrumb pull-left">
          <?php if (count($dataCatetag)==1): ?>
            <li class="bder-l3">
              <h4><a href="<?= Yii::$app->homeUrl.$dataCatetag['main']['slug'] ?>" title="Kinh doanh"><?= $dataCatetag['main']['cateName'] ?></a></h4>
            </li>
            <?php else: ?>
              
              <li class="start">
                <h4><a href="<?= Yii::$app->homeUrl.$dataCatetag['parent']['slug'] ?>" title="Kinh doanh"><?= $dataCatetag['parent']['cateName'] ?></a></h4>
              </li>
              <li>
                <h4><a href="<?= Yii::$app->homeUrl.$dataCatetag['main']['slug'] ?>"><?= $dataCatetag['main']['cateName'] ?></a></h4>
              </li> 
            <?php endif ?>
          </ul>
        </div>
      </div>
  </div>
  <!-- Popular Video -->
    <div class="col-md-8 image_slider">
      
      <section id="news-new">
        <?php foreach ($dataNew['news'] as $keynew => $valuenew):
          $image = str_replace('uploads', 'tin-tuc', $valuenew['images']);
          // $file_image = Yii::getAlias('@uploading').'/'.$image;
          
          // if (!file_exists($file_image) || $valuenew['images'] =='' || $valuenew['images'] =='') {
          //   $image = 'tin-tuc/no_image.png';
          // }
          if ($valuenew['images']=='') {
            $image = 'tin-tuc/no_image.png';
          }else {
            $image = $valuenew['images'];
          }
          // dbg($valuenew);
          ?>
         <div class="media">
          <div class="media-body"><h4 class="media-heading"><a href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html"><?= $valuenew['name'] ?></a></h4></div>
          <a class="pull-left" href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html">
            <img class="lazy_image" data-src="<?= Yii::$app->homeUrl.$image ?>"  width="130px">
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
  <div class="col-md-4 col-sm-12 col-xs-12 widget-area" id="sidebar">
    <?= newsTabsWidget::widget() ?>
    <?= cateNewsRightWidget::widget() ?>
  </div>
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