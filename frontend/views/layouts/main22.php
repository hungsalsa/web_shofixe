<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\headerAreaWidget;
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
        <!-- content start -->
        <?= $content ?>
        <!-- content end -->
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

<!-- QUICKVIEW PRODUCT -->
<div id="quickview-wrapper">
    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="modal-product">
                        <div class="product-images">
                            <div class="main-image images">
                                <img alt="" src="" id="imgPreview">
                            </div>
                        </div><!-- .product-images -->

                        <div class="product-info">
                            <h2 id="txtNameProduct"></h2>
                            <div class="price-box">
                                <p class="price"><span class="special-price"><span class="amount" id="txtPriceSales"></span><span class="old-price" id="txtprice"></span></span></p>
                            </div>
                            <a href="" class="see-all">Xem chi tiết</a>
                            <div class="quick-add-to-cart">
                                <form method="post" class="cart">
                                    <div class="numbers-row">
                                        <input type="number" id="french-hens" value="1">
                                    </div>
                                    <button class="single-add-to-cart-button" type="submit">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                            <div class="quick-desc" id="txtDescription">
                                
                            </div>
                            <div class="social-sharing">
                                <div class="widget widget_socialsharing_widget">
                                    <h3 class="widget-title-modal">Chia sẻ sản phẩm này</h3>
                                    <ul class="social-icons">
                                        <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a></li>
                                        <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a></li>
                                        <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .product-info -->
                    </div><!-- .modal-product -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
    <!-- END Modal -->
</div>
<!-- END QUICKVIEW PRODUCT -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



