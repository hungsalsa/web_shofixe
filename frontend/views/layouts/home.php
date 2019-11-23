<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\headerWidget;
use frontend\widgets\footerWidget;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php 
    $this->registerMetaTag(Yii::$app->params['og_title'], 'og_title');
    $this->registerMetaTag(Yii::$app->params['og_description'], 'og_description');
    $this->registerMetaTag(Yii::$app->params['og_url'], 'og_url');
    $this->registerMetaTag(Yii::$app->params['og_image'], 'og_image');
    $this->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->request->absoluteUrl]); 
    ?>
    <link rel="icon" type="image/x-icon" href="<?= Yii::$app->homeUrl ?>vender/images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="<?= Yii::$app->homeUrl ?>vender/images/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= Yii::$app->homeUrl ?>vender/images/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= Yii::$app->homeUrl ?>vender/images/apple-touch-icon-57x57-precomposed.png">   
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <?php $google_analytics = Yii::$app->cache->get('settings_app_website')['google_analytics']; dbg($google_analytics)?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= ($google_analytics!='')?$google_analytics :"UA-141506296-1" ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?= ($google_analytics!='')?$google_analytics :"UA-141506296-1" ?>');
    </script> 

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="sticky_menu">
    <?php $this->beginBody() ?>
    <!-- Loader -->
    <!-- <div id="site-loader" class="load-complete">
        <div class="loader">
            <div class="loader-inner ball-clip-rotate">
                <div></div>
            </div>
        </div>
    </div> -->
    <!-- Loader /- -->
    <!-- Header Section -->
    <?= headerWidget::widget() ?>
    <!-- Header Section /- -->
    <div class="main-container">
        <main class="site-main">
            <?= $content ?>
            
        </main>
    </div>
    <!-- Footer Main -->
    <?= footerWidget::widget() ?>
    <!-- Footer Main /- --> 


    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
