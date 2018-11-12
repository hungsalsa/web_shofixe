<?php use yii\helpers\Url; ?>
<section class="section seller-product wow fadeInUp">
    <h3 class="section-title">Sản phẩm bán chạy</h3>
    <div class="row outer-top-xs">
        <?php $i=1; foreach ($dataproduct as $value): ?>
            <div class="col-md-4 col-sm-6">
                <div class="products">
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-6">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="<?= $value['image'] ?>" data-lightbox="image-1" data-title="Nunc ullamcors">
                                                <img data-echo="<?= $value['image'] ?>" src="<?= Yii::$app->homeUrl?>vender/images/blank.gif" alt="<?= $value['title'] ?>" width="98%">
                                                <div class="zoom-overlay"></div>
                                            </a>                    
                                        </div><!-- /.image -->
                                    </div><!-- /.product-image -->
                                </div><!-- /.col -->
                                <div class="col col-xs-6">
                                    <div class="product-info">
                                        <h3 class="name"  title="<?= $value['pro_name'] ?>"><a href="<?= Url::to(['product/view', 'slug' => $value['slug']]) ?>"><?= $value['pro_name'] ?></a></h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="product-price"> 
                                            <span class="price">
                                                $<?= $value['price_sales'] ?>
                                            </span>
                                            <span class="price-before-discount">$<?= $value['price'] ?></span>
                                        </div><!-- /.product-price -->
                                        <div class="action m-t-10"><a href="" class="lnk btn btn-primary" onclick="addCart(<?= $value->id ?>)">Add To Cart</a></div>
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.product-micro-row -->
                        </div><!-- /.product-micro -->
                    </div>
                </div>
            </div>
            <?php if ($i==3): ?>
                
            <div class="clearfix"></div>
            <?php endif ?>
        <?php $i++; endforeach ?>

    </div>
</section>