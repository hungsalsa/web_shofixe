<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\headerAreaWidget;
use frontend\widgets\sliderWidget;
use frontend\widgets\sliderBottomWidget;
use frontend\widgets\arrivalWidget;
use frontend\widgets\featuredWidget;
use frontend\widgets\bannerAreaWidget;
use frontend\widgets\womenAreaWidget;
use frontend\widgets\offerAreaWidget;
use frontend\widgets\menAreaWidget;
use frontend\widgets\newsletterWidget;
use frontend\widgets\blogAreaWidget;
use frontend\widgets\testimonialAreaWidget;
use frontend\widgets\clientAreaWidget;
use frontend\widgets\serviceAreaWidget;
use frontend\widgets\touchAreaWidget;
use frontend\widgets\footerWidget;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

<!-- Pre Loader
    ============================================ -->
    <div class="preloader">
        <div class="loading-center">
            <div class="loading-center-absolute">
                <div class="object object_one"></div>
                <div class="object object_two"></div>
                <div class="object object_three"></div>
            </div>
        </div>
    </div>
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="as-mainwrapper">
    <div class="bg-white">
        <!-- header start -->
        <?= headerAreaWidget::widget() ?>
        <!-- header end -->
        <!-- slider start -->
        <?= sliderWidget::widget() ?>
        <!-- slider end -->
        <!-- slider bottom start -->
        <?= sliderBottomWidget::widget() ?>
        <!--slider bottom end -->
        <!-- arrival start-->
        <?= arrivalWidget::widget() ?>
        <!-- arrival end -->
        <!-- featured start -->
        <?= featuredWidget::widget() ?>
        <!-- featured end -->
        <!-- off banner area start -->
        <?= bannerAreaWidget::widget() ?>
        <!-- off banner area end -->
        <!-- women area start -->
        <?= womenAreaWidget::widget() ?>
        <!-- women area end -->
        <!-- offer area start -->
        <?= offerAreaWidget::widget() ?>
        <!-- offer area end -->
        <!-- men area start -->
        <?= menAreaWidget::widget() ?>
        <!-- men area end -->
        <!-- newsletter area start -->
        <?= newsletterWidget::widget() ?>
        <!-- newsletter area end -->
        <!-- blog area start -->
        <?= blogAreaWidget::widget() ?>
        <!-- blog area end -->
        <!-- testimonial area start -->
        <?= testimonialAreaWidget::widget() ?>
        <!-- testimonial area end -->
        <!-- client area start -->
        <?= clientAreaWidget::widget() ?>
        <!-- client area end -->
        <!-- service area end -->
        <?= serviceAreaWidget::widget() ?>
        <!-- service area end -->
        <!-- touch area end -->
        <?= touchAreaWidget::widget() ?>
        <!-- touch area end -->
        <!-- footer start -->
        <?= footerWidget::widget() ?>
        <!-- footer end -->

    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
