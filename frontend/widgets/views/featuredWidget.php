<?php $formatter = \Yii::$app->formatter; if (!empty($products)): ?>
   <!-- <pre> -->
<?php 
// print_r($products);
// die;
?>
<div class="featured-area ptb-90">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="section-tab">
               <div class="section-tab-menu mb-45 text-center">
                  <ul role="tablist">
                     <?php foreach ($dataProType as $key => $value): ?>
                     <li role="presentation" class="<?= ($key == 0)? 'active':'' ?> text-uppercase"><a href="#featured_<?= $value->product_type_id  ?>" aria-controls="featured_<?= $value->product_type_id ?>" role="tab" data-toggle="tab"><?= $value->name ?></a></li>
                     <?php endforeach ?>

                     <!-- <li role="presentation" class="text-uppercase"><a href="#trendy" aria-controls="trendy" role="tab" data-toggle="tab">Trendy</a></li>
                     <li role="presentation" class="text-uppercase"><a href="#best1" aria-controls="best1" role="tab" data-toggle="tab">Best Selling</a></li> -->
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <?php 
         $ranPro = $products[array_rand($products)];
         ?>
         <div class="col-md-5 hidden-sm hidden-xs">
            <div class="featured-left mt-2">
               <a href="#">
               <img src="<?= Yii::$app->homeUrl.$ranPro->image?>" alt="<?= $ranPro->title ?>" style="height: 542px;">
               </a>
               <span class="red hidden-sm" style="margin-left: 35px">hot</span>
            </div>
            <div class="single-product-info clearfix">
               <div class="pro-title">
                  <h3><a href="#"><?= $ranPro->pro_name ?></a></h3>
               </div>
               <div class="pro-price">
                  <span class="new-price txtPriceSales_<?= $value->id ?>"><?= $formatter->asDecimal($ranPro->price_sales,0) ?></span>
                  <?php if ($ranPro->price != 0): ?>
                     <span class="old-price txtPrice_<?= $value->id ?>"><?= $formatter->asDecimal($ranPro->price,0) ?></span>
                  <?php endif ?>
               </div>
            </div>
         </div>
         <div class="col-md-7">
            <div class="clearfix"></div>
            <div class="tab-content row">
               <?php foreach ($dataProType as $key => $value): ?>
               <div id="featured_<?= $value->product_type_id  ?>" role="tabpanel" class="<?= ($key == 0)? 'active':'' ?> section-tab-item">
                  <div class="feature-slider">
                     <div class="col-xs-12 col-width">
                     <?php $i=1; foreach ($products as $product): 
                        if ($product->product_type_id == '') {
                           continue;
                        }

                        if (!in_array($value->product_type_id,json_decode($product->product_type_id))) {
                           continue;
                        }
                     ?>
                        <div class="single-product">
                           <div class="single-product-item clearfix">
                              <div class="single-product-img clearfix">
                                 <a href="#">
                                 <img class="primary-image" src="<?= Yii::$app->homeUrl.$product->image?>" alt="product" style="width: 204px;height: 236px">
                                 </a>
                                 <div class="wish-icon-hover text-center clearfix">
                                    <div class="hover-text">
                                       <p class="hidden-md"><?= $product->short_introduction ?></p>
                                       <ul>
                                          <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                          <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                          <li class="hidden-md"><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                          <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <div class="single-product-info clearfix">
                                 <div class="pro-title">
                                    <h3><a href="#"><?= $product->pro_name ?></a></h3>
                                 </div>
                                 <div class="pro-price">
                                    <span class="new-price"><?= $formatter->asDecimal($product->price_sales,0) ?></span>
                                    <?php if ($product->price != 0): ?>
                                       <span class="old-price txtPrice_<?= $product->id ?>"><?= $formatter->asDecimal($product->price,0) ?></span>
                                    <?php endif ?>
                                 </div>
                              </div>
                           </div>
                           <span class="black hidden-sm"><?= $value->name ?></span>
                        </div>
                        
                        <?php if ($i%2 ==0): ?>
                           </div>
                           <div class="col-xs-12 col-width">
                        <?php endif ?>
                     <?php $i++; endforeach ?>
                     </div>
                     
                  </div>
               </div>
               <?php endforeach ?>

            </div>
            <div class="arrival-button text-left">
               <a href='#' class='section-button mt-30'>View More</a>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif ?>