<?php if ($cateSetting): ?>
  <?php foreach ($cateSetting as $key => $value): ?>
<section class="news-right">
    <h2 class="title_box_category"><a href="" class="first"><?= $value['moduleName'] ?></a></h2>
    
    <?php foreach ($value['news'] as $keynew => $valuenew): $image = str_replace('uploads', 'tin-tuc', $valuenew['images']);
      $file_image = Yii::getAlias('@uploading').'/'.$image;
        
        if (!file_exists($file_image)) {
          $image = 'tin-tuc/no_image.png';
        } ?>
    <div class="media">
      <a class="pull-left" href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html">
        <img class="media-object lazy_image" data-src="<?= Yii::$app->homeUrl.$image ?>" alt="<?= $valuenew['seo_title'] ?>" width="100px">
      </a>
      <div class="media-body title_news"><h4 class="media-heading"><a href="<?= Yii::$app->homeUrl.$valuenew['slug'] ?>.html"><?= $valuenew['name'] ?></a></h4></div>
      <p><?= $valuenew['short_description'] ?></p>
    </div>
    <?php endforeach ?>
    
  </section>

  <?php endforeach ?>
<?php endif ?>