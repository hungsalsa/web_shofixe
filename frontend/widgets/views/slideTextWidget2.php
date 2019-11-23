<div class="container slide-text">
    <div class="row">
      <?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id =='index'): ?>
        <div class="col-md-1">
        <p>Sự kiện: </p>
      </div>
      <div class="col-md-11"><marquee behavior="scroll" direction="left" id="marq" loop="50" onmouseout="this.start()" onmouseover="this.stop()" scrollamount="3" scrolldelay="0">
        <?php foreach ($news_hot_2 as $value): ?>
          <i class="fas fa-plus"></i><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>.html"><?= $value['name'] ?></a>
        <?php endforeach ?>
      </marquee></div>
      <?php else: ?>
      <ul class="breadcrumb pull-left">
        <li class="start">
          <h4><a href="/kinh-doanh" title="Kinh doanh">Kinh doanh</a></h4>
        </li>
        <li>
          <h4><a href="/kinh-doanh/vi-mo">Vĩ mô</a></h4>
        </li> 
      </ul>
      <div class="pull-right not_timer">
        <span class="top-contact">
          <i class="fa fa-phone-volume"></i> <strong>083.888.0123</strong> (HN) - <strong>082.233.3555</strong> (TP HCM)
        </span>
        <a href="https://vnexpress.net/lien-he-quang-cao" title="quảng cáo" class="box_ad">
          <i class="fa fa-adversal"></i>090 293 9644
        </a>
      </div>
      <?php endif ?>
      

    </div>
  </div>