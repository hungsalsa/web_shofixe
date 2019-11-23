<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$app_cache_header = Yii::$app->cache->get('app_cache_header');
// dbg($app_cache_header['banner']['content_mobile']);
 ?>
<header>
   <div class="container-fluid" id="top-time-search">
      <div class="container">
        <div class="col-xs-12 col-sm-8 col-md-6" id="top-time">
          <?= $datetimenow ?> (GMT+7)
        </div>
        <?php if (Yii::$app->controller->id != "search"): ?>
        <div class="col-xs-12 col-sm-6 col-md-6 pull-right" id="top-search">
          <?php $form = ActiveForm::begin([
            'action' => ['search/view'],
            'method'  => 'get',
            'options' => ['class' => 'form-inline']
          ]
        );
        ?>
          <div class="input-group col-md-12">
            <?= Html::textInput('keySearch', null, ['class' => 'textSearch form-control',"placeholder"=>" Tìm kiếm ","style"=>"width:80%"]) ?>
            <?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-default']) ?>
          </div>
          <?php ActiveForm::end();?>
        </div>

        <?php endif ?>
      </div>
    </div>
<div class="container banner-top">
   <div class="row">
      <!-- <div class="col-md-12"> -->
        
          <?php if ($app_cache_header['banner']['content'] !='' || $app_cache_header['banner']['content_mobile'] !=''): ?>
            <div class="desktop"><?= $app_cache_header['banner']['content'] ?></div>
            <div class="mobile"><?= $app_cache_header['banner']['content_mobile'] ?></div>
          <?php else: ?>
            <a href=""><img src="<?= Yii::$app->homeUrl ?>vender/images/logo.gif" alt="VietLinkTravel"></a>
          <?php endif ?>
      <!-- </div> -->
   </div>
</div>
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Tiếng Còi</a>
  </div>
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   <ul class="nav navbar-nav mainmenu">
    <li><a href="<?= Yii::$app->homeUrl ?>">Trang chủ</a></li>
    <?php foreach ($app_cache_header['dataMenu'] as $value): ?>
      <?php if (empty($value['dataSubmenu'])): ?>
        <li><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>"><?= $value['name'] ?></a></li>
      <?php else: ?>
      <li class="dropdown"><a href="<?= Yii::$app->homeUrl.$value['slug'] ?>"><?= $value['name'] ?><?= (empty($value['dataSubmenu']))?'':' <span class="caret"></span>' ?>
        </a>
        <?php if (!empty($value['dataSubmenu'])): ?>
          
        <ul class="dropdown-menu submenu">
          <?php foreach ($value['dataSubmenu'] as $Submenu): ?>
            
          <li><a href="<?= Yii::$app->homeUrl.$Submenu['slug'] ?>"><?= $Submenu['name'] ?></a></li>
          <?php endforeach ?>
        </ul>
        <?php endif ?>
      </li>
        
      <?php endif ?>
    <?php endforeach ?>
  </ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
</header>
