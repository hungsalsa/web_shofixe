<section class="news-tabs">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active"><a href="#one" role="tab" data-toggle="tab">Tin mới</a></li>
      <li><a href="#two" role="tab" data-toggle="tab">Xem nhiều</a></li>
      <li><a href="#three" role="tab" data-toggle="tab">Videos</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="one">
        <?php foreach ($data['latestNews'] as $value): 
          
          $image = str_replace('uploads', 'tin-tuc', $value['images']);
          $file_image = Yii::$app->request->hostinfo.'/'.$image;

          if($value['images'] =='') {
            $image = 'tin-tuc/no_image.png';
          }
        ?>
          
        <div class="media">
          <a class="pull-left" href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html">
            <img class="media-object lazy_image" data-src="<?= Yii::$app->homeUrl.$image ?>" alt="<?= $value['seo_title'] ?>" width="100px">
          </a>
          <div class="media-body"><h4 class="media-heading title_news"><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><?= $value['name'] ?></a></h4></div>
        </div>
        <?php endforeach ?>
        
      </div>

      <div class="tab-pane" id="two">
        
        <?php foreach ($data['MostViewedNews'] as $value): 
          $image = str_replace('uploads', 'tin-tuc', $value['images']);
          $file_image = Yii::$app->request->hostinfo.'/'.$value['images'];
          

          if($value['images'] =='') {
            $image = 'tin-tuc/no_image.png';
          } ?>
        <div class="media">
          <a class="pull-left" href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html">
            <img class="media-object lazy_image" data-src="<?= Yii::$app->homeUrl.$image ?>" alt="<?= $value['seo_title'] ?>" width="80px">
          </a>
          <div class="media-body"><h4 class="media-heading title_news"><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><?= $value['name'] ?></a></h4></div>
        </div>
        <?php endforeach ?>

      </div>

      <div class="tab-pane" id="three">
        <?php foreach ($data['Videos'] as $value): ?>
        <div class="youtube">
          <h2><?= $value['name'] ?></h2>
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" width="100%" height="200" src="<?= $value['link'] ?>"></iframe>
          </div>
        </div>
        <?php endforeach ?>
        <p><a href="<?= Yii::$app->homeUrl ?>videos/danh-sach">Xem thêm</a></p>
        <!-- <div class="youtube">
          <h2>Thời sự VTV1 19h hôm nay ngày 6/4/2019</h2>
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/6o8mwk76xgE"></iframe>
          </div>
        </div>
        <div class="youtube">
          <h2>Thời sự VTV1 19h hôm nay ngày 6/4/2019</h2>
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/6o8mwk76xgE"></iframe>
          </div>
        </div>
        
              </div> -->

    </div>
  </section>