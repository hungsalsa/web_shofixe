<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
// use frontend\widgets\topMenuWidget;
use frontend\widgets\navBarWidget;
use frontend\widgets\mainHeaderWidget;
use frontend\widgets\footerWidget;
use frontend\widgets\brandsCarouselWidget;
use frontend\widgets\modalCartWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>vender/images/favicon.ico">
    <?php $this->head() ?>
    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
        <script src="<?= Yii::$app->homeUrl ?>vender/js/html5shiv.js"></script>
        <script src="<?= Yii::$app->homeUrl ?>vender/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="cnt-home">
    <?php $this->beginBody() ?>
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1 header-style-3">

        <!-- ============================================== TOP MENU ============================================== -->
        <?php// topMenuWidget::widget() ?>
        <!-- ============================================== TOP MENU : END ============================================== -->
        <!-- ============================================== MAIN HEADER ============================================== -->
        <?= mainHeaderWidget::widget() ?>
        <!-- ============================================== MAIN HEADER : END ============================================== -->

        <!-- ============================================== NAVBAR ============================================== -->
        <?= navBarWidget::widget() ?>
        <!-- ============================================== NAVBAR : END ============================================== -->

    </header>
    <!-- ============================================== HEADER : END ============================================== -->
    <!-- =========BREADCRUMB========================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Smart Phone</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <!-- =========BREADCRUMB :END========================== -->
    <!-- ============================================== BODY-CONTENT ============================================== -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class="homepage-container">
                <div class='row single-product outer-bottom-sm' id="content">
                    <?= $content ?>
                </div>
                <?= brandsCarouselWidget::widget() ?>
            </div>
        </div><!-- /#top-banner-and-menu -->
    </div>
    <!-- ============================================== BODY-CONTENT :END ============================================== -->

    <!-- ============================================================= FOOTER ============================================================= -->
    <?= footerWidget::widget() ?>
    <!-- ============================================================= FOOTER : END============================================================= -->
    
    <!-- MODAL SU DUNG GIO HANG -->
    <?= modalCartWidget::widget() ?>
    <!-- MODAL SU DUNG GIO HANG -->
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
