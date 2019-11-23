      <?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id =='index'): ?>
<div class="container slide-text">
    <div class="row">
        <div class="col-md-1">
        <p>Sự kiện: </p>
      </div>
      <div class="col-md-11"><marquee behavior="scroll" direction="left" id="marq" loop="50" onmouseout="this.start()" onmouseover="this.stop()" scrollamount="3" scrolldelay="0">
        <?php foreach ($news_hot_2 as $value): ?>
          <i class="fas fa-plus"></i><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><?= $value['name'] ?></a>
        <?php endforeach ?>
      </marquee></div>
    </div>
  </div>
      <?php endif ?>