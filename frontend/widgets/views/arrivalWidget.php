<?php 
foreach ($dataProType as $key => $value) {

   if ($value == 'mới') {
      $new = $key;
      unset($dataProType[$key]);
      continue;
   }
   if ($value == 'phổ biến') {
      $featured = $key;
      unset($dataProType[$key]);
      continue;
   }
   if ($value == 'bán chạy') {
      $best = $key;
      unset($dataProType[$key]);
      continue;
   }
}
// print_r($dataProType);
?>

<div class="arrival-area clearfix pt-90">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="section-tab">
               <div class="section-tab-menu text-center mb-45">
                  <ul role="tablist">
                     <li role="presentation" class="active text-uppercase"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Sản phẩm mới</a></li>
                     <li role="presentation" class="text-uppercase"><a href="#featured" aria-controls="featured" role="tab" data-toggle="tab">Sản phẩm phổ biến</a></li>
                     <li role="presentation" class="text-uppercase"><a href="#best" aria-controls="best" role="tab" data-toggle="tab">Sản phẩm bán chạy</a></li>
                  </ul>
               </div>
               <div class="clearfix"></div>
               <div class="tab-content row">
   
                  <div id="new" role="tabpanel" class="active section-tab-item">
                     <div class="tab-item-slider">
                        <?php foreach ($product as $value): ?>
                           <?php 
                              if (!in_array($new,json_decode($value->product_type_id))) {
                                 continue;
                              }
                              $formatter = \Yii::$app->formatter;
                           ?>
                        <div class="col-xs-12 col-width">
                           <div class="single-product">
                              <div class="single-product-item clearfix">
                                 <div class="single-product-img clearfix">
                                    <a href="#">
                                    <img class="primary-image imgPro_<?= $value->id ?>" src="<?= Yii::$app->homeUrl.$value->image ?>" alt="<?= $value->title ?>">
                                    </a>
                                    <div class="wish-icon-hover text-center clearfix">
                                       <div class="hover-text">
                                          <p class="description_<?= $value->id ?>"><?= $value->short_introduction ?></p>
                                          <ul>
                                             <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                             <li onclick="quickView(<?= $value->id ?>)"><a class="modal-view" href="" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                             <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                             <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="single-product-info clearfix">
                                    <div class="pro-rating">  
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>  
                                    </div>
                                    <div class="pro-price">
                                       <span class="new-price txtPriceSales_<?= $value->id ?>"><?= $formatter->asDecimal($value->price_sales,0) ?></span>
                                       <?php if ($value->price != 0): ?>
                                       <span class="old-price txtPrice_<?= $value->id ?>"><?= $formatter->asDecimal($value->price,0) ?></span>
                                       <?php endif ?>
                                    </div>
                                    <h3 class="txtPro_<?= $value->id ?>"><a href="#"><?= $value->pro_name ?></a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php endforeach ?>
                     </div>
                  </div>

                  <div id="featured" role="tabpanel" class="section-tab-item">
                     <div class="tab-item-slider">
                        <?php foreach ($product as $value): ?>
                           <?php 
                              if (!in_array($featured,json_decode($value->product_type_id))) {
                                 continue;
                              }
                              $formatter = \Yii::$app->formatter;
                           ?>
                        <div class="col-xs-12 col-width">
                           <div class="single-product">
                              <div class="single-product-item">
                                 <div class="single-product-img clearfix hover-effect">
                                    <a href="#">
                                    <img class="primary-image imgPro_<?= $value->id ?>" src="<?= Yii::$app->homeUrl.$value->image ?>" alt="<?= $value->title ?>">
                                    </a>
                                    <div class="wish-icon-hover text-center clearfix">
                                       <div class="hover-text">
                                          <p class="description_<?= $value->id ?>"><?= $value->short_introduction ?></p>
                                          <ul>
                                             <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                             <li onclick="quickView(<?= $value->id ?>)"><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                             <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                             <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="single-product-info clearfix">
                                    <div class="pro-rating"> 
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                    </div>
                                    <div class="pro-price">
                                       <span class="new-price txtPriceSales_<?= $value->id ?>"><?= $formatter->asDecimal($value->price_sales,0) ?></span>
                                       <?php if ($value->price != 0): ?>
                                       <span class="old-price txtPrice_<?= $value->id ?>"><?= $formatter->asDecimal($value->price,0) ?></span>
                                       <?php endif ?>
                                    </div>
                                    <h3 class="txtPro_<?= $value->id ?>"><a href="#"><?= $value->pro_name ?></a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php endforeach ?>
                        
                     </div>
                  </div>

                  <div id="best" role="tabpanel" class="section-tab-item">
                     <div class="tab-item-slider">
                        <?php foreach ($product as $value): ?>
                           <?php 
                              if (!in_array($best,json_decode($value->product_type_id))) {
                                 continue;
                              }
                              $formatter = \Yii::$app->formatter;
                           ?>
                        <div class="col-xs-12 col-width">
                           <div class="single-product">
                              <div class="single-product-item">
                                 <div class="single-product-img clearfix hover-effect">
                                    <a href="#">
                                       <img class="primary-image imgPro_<?= $value->id ?>" src="<?= Yii::$app->homeUrl.$value->image ?>" alt="<?= $value->title ?>">
                                    </a>
                                    <div class="wish-icon-hover text-center clearfix">
                                       <div class="hover-text">
                                          <p class="description_<?= $value->id ?>"><?= $value->short_introduction ?></p>
                                          <ul>
                                             <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                             <li onclick="quickView(<?= $value->id ?>)"><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                             <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                             <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="single-product-info clearfix">
                                    <div class="pro-rating"> 
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                    </div>
                                    <div class="pro-price">
                                       <span class="new-price txtPriceSales_<?= $value->id ?>"><?= $formatter->asDecimal($value->price_sales,0) ?></span>
                                       <?php if ($value->price != 0): ?>
                                       <span class="old-price txtPrice_<?= $value->id ?>"><?= $formatter->asDecimal($value->price,0) ?></span>
                                       <?php endif ?>
                                    </div>
                                    <h3 class="txtPro_<?= $value->id ?>"><a href="#"><?= $value->pro_name ?></a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php endforeach ?>
                        
                     </div>
                  </div>
               </div>
            </div>
            <div class="arrival-button text-center mt-30">
               <a href='#' class='section-button'>View More</a>
            </div>
         </div>
      </div>
   </div>
</div>
