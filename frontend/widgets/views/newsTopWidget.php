<section id="news-top">
    <!-- <h3 style="font-size: 16px;">Tin nổi bật</h3> -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="col-md-8 image_slider">
        <div class="carousel-inner">
          <?php foreach ($news_hot as $key => $value): ?>
            
          <div class="item <?= ($key==0)? "active":"" ?>">
           <a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><img class="lazy_image" data-src="<?= Yii::$app->homeUrl.$value['images'] ?>" alt="<?= $value['seo_title'] ?>"></a>
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
          <?php foreach ($news_hot as $key => $value): ?>
          <li class="list-group-item <?= ($key==0)? "active":"" ?>"> 
            <a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><?= $value['name'] ?></a>
            <!-- <p><?= $value['short_description'] ?></p>  -->
          </li> 
          <?php endforeach ?>
          
        </ul>
      </div>
    </div>
  </section>