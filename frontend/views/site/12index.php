<?php
// use frontend\widgets\sectionHeroWidget;

/* @var $this yii\web\View */

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
$this->title = 'Chào mừng đến với nhớt xinh.vn';
?>
        <!-- // echo Yii::$app->controller->id;
        // echo Yii::$app->controller->action->id;die;
        // Kiểm tra có phải trang chủ ko? -->
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
        <?php // newsletterWidget::widget() ?>
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
        