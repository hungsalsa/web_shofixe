<?php if ($cateSetting): ?>
<section id="news-new">
  <?php foreach ($cateSetting as $key => $value): ?>
  
    <div class="col-md-6">
      <h2 class="title_box_category"><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>" class="first"><?= $value['moduleName'] ?></a></h2>
      
      <?php foreach ($value['news'] as $keynew => $valuenew): ?>
        
      <?php if ($keynew == 0): 
        if (strpos($valuenew['images'], 'uploads') !== false) {
          $image = str_replace('uploads', 'tin-tuc', $valuenew['images']);
        } else {
          $image = $valuenew['images'];
        }
        $file_image = Yii::$app->request->hostinfo.'/'.$image;
   
        if($valuenew['images'] =='') {
          $image = 'tin-tuc/no_image.png';
        }
 
        ?>
        <div class="media">
          <h4 class="media-heading title_news"><a href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html"><?= $valuenew['name'] ?></a></h4>
          <a class="pull-left" href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html">
            <img class="media-object lazy_image" data-src="<?= Yii::$app->homeUrl.$image ?>" alt="<?= $valuenew['seo_title'] ?>" width="130px">
          </a>
          <p class="description"><?= $valuenew['short_description'] ?></p>
          
        </div>
      <?php else: ?>
        <?php if ($keynew == 1): ?>
          <ul class="list_title ">
        <?php endif ?>
        <li><i class="fas fa-square-full"></i> <a href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html"><?= ucfirst(mb_strtolower($valuenew['name'], 'UTF-8'))?></a>  <span>12/4/2019</span></li>
      <?php endif ?>

      <?php endforeach ?>
      <?php if (count($value['news'])>1): ?>
        </ul>
        
      <?php endif ?>

    </div>

  <?php if (($key+1)%2 == 0): ?>
    <div class="clearfix"></div>
  <?php endif ?>

  <?php endforeach ?>
  </section>
<?php endif ?>