<?php
/* @var $this yii\web\View */
?>
<!-- banner start -->
                <div class="banner-area ptb-110">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="banner-text text-center">
                                    <div class="banner-title">
                                        <h2 class="text-uppercase">products</h2>
                                        <!-- <img src="img/banner/4.jpg"> -->
                                    </div>
                                    <div class="breadcrumbs">
                                        <ul>
                                            <li><a href="index.html">Home</a> ></li>
                                            <li class="text-capitalize">shop</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- banner end -->
                <!-- shop start -->
                <div class="shop-area mt-90">
                    <div class="container">
                        <div class="row">
                            <div class="shop-item-filter">
                                <div class="col-lg-4 col-md-3 col-sm-5 col-xs-5">
                                    <div class="shop-tab clearfix">
                                        <!-- Nav tabs -->
                                        <ul role="tablist">
                                            <li role="presentation" class="active"><a data-toggle="tab" role="tab" aria-controls="grid" class="grid-view" href="#grid"><i class="fa fa-th"></i></a></li>
                                            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list" class="list-view" href="#list"><i class="fa fa-list"></i></a></li>
                                        </ul>
                                    </div>
                                </div>    
                                <div class="col-lg-4 col-md-5 hidden-sm hidden-xs">      
                                    <div class="filter-by">
                                        <h4>Short by: </h4>
                                        <form action="#">
                                            <div class="select-filter">
                                                <select>
                                                  <option value="color">Position</option>
                                                  <option value="name">Name</option>
                                                  <option value="brand">Brand</option>
                                                </select> 
                                            </div>
                                        </form>								
                                    </div>
                                    <div class="filter-by">
                                        <h4>Show: </h4>
                                        <form action="#">
                                            <div class="select-filter">
                                                <select>
                                                  <option value="10">12</option>
                                                  <option value="20">16</option>
                                                  <option value="30">20</option>
                                                </select> 
                                            </div>
                                        </form>	
                                    </div>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
                                    <div class="page-menu float-right">     
                                        <ul>
                                            <li class="li-page">page: </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li class="hidden-xs"><a href="#">3</a></li>
                                            <li class="hidden-xs"><a href="#">4</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="tab-content mt-25">
                            <div id="grid" class="tab-pane active" role="tabpanel">
                                <div class="row">
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/1.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale">
                                                <span class="black hidden-sm">new</span>
                                                <span class="red hidden-sm">hot</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/2.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale">
                                                <span class="red hidden-sm">sale</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/3.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/4.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale">
                                                <span class="red hidden-sm">hot</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/5.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/24.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$135</span>
                                                        <span class="old-price">$145</span>
                                                    </div> 
                                                    <h3><a href="#">Peletria ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale m-10">
                                                <span class="red hidden-sm">hot</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/25.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$120</span>
                                                        <span class="old-price">$130</span>
                                                    </div>
                                                    <h3><a href="#">Niletria postma</a></h3>  
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/26.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$100</span>
                                                        <span class="old-price">$120</span>
                                                    </div>  
                                                    <div class="new-sale">
                                                        <span class="red hidden-sm">sale</span>
                                                    </div>
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/27.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale">
                                                <span class="red hidden-sm">hot</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/28.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div>  
                                                    <div class="new-sale">
                                                        <span class="black hidden-sm">new</span>
                                                        <span class="red hidden-sm">sale</span>
                                                    </div>
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/29.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale">
                                                <span class="black hidden-sm">new</span>
                                                <span class="red hidden-sm">hot</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/30.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale">
                                                <span class="red hidden-sm">sale</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/31.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/32.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale">
                                                <span class="red hidden-sm">hot</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/33.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/34.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$135</span>
                                                        <span class="old-price">$145</span>
                                                    </div> 
                                                    <h3><a href="#">Peletria ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale m-10">
                                                <span class="red hidden-sm">hot</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/35.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$120</span>
                                                        <span class="old-price">$130</span>
                                                    </div>
                                                    <h3><a href="#">Niletria postma</a></h3>  
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/36.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$100</span>
                                                        <span class="old-price">$120</span>
                                                    </div>  
                                                    <div class="new-sale">
                                                        <span class="red hidden-sm">sale</span>
                                                    </div>
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width hidden-sm">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/37.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div> 
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                            <div class="new-sale">
                                                <span class="red hidden-sm">hot</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-width hidden-sm">
                                        <div class="single-product mb-30">
                                            <div class="single-product-item clearfix">
                                                <div class="single-product-img clearfix">
                                                    <a href="#">
                                                        <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/38.jpg" alt="">
                                                    </a>
                                                    <div class="wish-icon-hover text-center clearfix">
                                                        <div class="hover-text">
                                                            <p>Duis autem vel eum iriure dolor in hendrerit in tate velit esse lestiesequat  </p>
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
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
                                                        <span class="new-price">$150</span>
                                                        <span class="old-price">$180</span>
                                                    </div>  
                                                    <div class="new-sale">
                                                        <span class="black hidden-sm">new</span>
                                                        <span class="red hidden-sm">sale</span>
                                                    </div>
                                                    <h3><a href="#">Electria Ostma</a></h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="list" class="tab-pane" role="tabpanel">
                                <div class="row">
                                <div class="col-md-3">
                                <div class="shop-left-sidebar">
                                    <div class="single-left-widget">
                                        <div class="section-title">
                                            <h4 class="text-uppercase">category</h4>
                                            <ul>
                                                <li class="active"><a href="#"><i class="fa fa-angle-right"></i>Men's Collection (275)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Women's Collection (320)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Kid's Collection (275)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Accessories (220)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Bag's Collection (175)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Shoes Collection (150)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="single-left-widget">
                                        <div class="section-title">
                                            <h4 class="text-uppercase">materials</h4>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Cotton (180)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Cotton Blends (150)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Lilen (120)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Polister Blends (175)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Jeans (150)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="single-left-widget">
                                        <div class="section-title">
                                            <h4 class="text-uppercase">brands</h4>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Zara (150)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Walmart (100)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Arong (150)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Velloci (120)</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i>Dolce &amp; Gabbana (175)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="single-left-widget">
                                        <div class="section-title">
                                            <h4 class="text-uppercase">filter by price</h4>
                                            <div class="price-filter">
                                                <div id="slider-range"></div>
                                                <div class="price-slider-amount">
                                                   <div class="slider-values">
                                                        <input type="text" id="amount" name="price"  placeholder="Add Your Price" /> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-left-widget">
                                        <div class="section-title">
                                            <h4 class="text-uppercase">filter by size</h4>
                                            <ul class="size-widget">
                                                <li class="active"><a href="#">XS</a></li>
                                                <li><a href="#">S</a></li>
                                                <li><a href="#">M</a></li>
                                                <li><a href="#">L</a></li>
                                                <li><a href="#">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="single-left-widget">
                                        <div class="section-title">
                                            <h4 class="text-uppercase">filter by color</h4>
                                            <ul class="color-widget">
                                                <li class="active white"><a href="#"></a></li>
                                                <li class="red"><a href="#"></a></li>
                                                <li class="merun"><a href="#"></a></li>
                                                <li class="megenta"><a href="#"></a></li>
                                                <li class="blue"><a href="#"></a></li>
                                                <li class="neviblue"><a href="#"></a></li>
                                                <li class="green"><a href="#"></a></li>
                                                <li class="yellow"><a href="#"></a></li>
                                                <li class="purple"><a href="#"></a></li>
                                                <li class="black"><a href="#"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="single-left-widget">
                                        <div class="section-title">
                                            <h4 class="text-uppercase">tags</h4>
                                            <ul class="widget-tag">
                                                <li class="active"><a href="#">men</a></li>
                                                <li><a href="#">kid's</a></li>
                                                <li><a href="#">women</a></li>
                                                <li><a href="#">fashion</a></li>
                                                <li><a href="#">kid's</a></li>
                                                <li><a href="#">men</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="single-product shop-list mb-48">
                                            <div class="single-product-item clearfix">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                                        <div class="single-product-img clearfix">
                                                            <a href="#">
                                                                <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="new-sale list">
                                                            <span class="black">new</span>
                                                            <span class="red">sale</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                                        <div class="single-product-info mt-30 clearfix">
                                                            <h3><a href="#">Eletria postma</a></h3>
                                                            <div class="pro-rating">  
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <span>1 Review(s)</span>
                                                            </div> 
                                                            <div class="pro-price">
                                                                <span class="new-price">$150</span>
                                                                <span class="old-price">$180</span>
                                                            </div> 
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris    nisi ut aliquip reprehenderit. </p> 
                                                        </div>
                                                        <div class="wish-icon-hover-list text-left clearfix">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                            </ul> 
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="single-product shop-list mb-48">
                                            <div class="single-product-item clearfix">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                                        <div class="single-product-img clearfix">
                                                            <a href="#">
                                                                <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/2.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="new-sale list">
                                                            <span class="black">new</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                                        <div class="single-product-info mt-20 clearfix">
                                                            <h3><a href="#">Eletria postma</a></h3>
                                                            <div class="pro-rating">  
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div> 
                                                            <div class="pro-price">
                                                                <span class="new-price">$150</span>
                                                                <span class="old-price">$180</span>
                                                            </div> 
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris    nisi ut aliquip reprehenderit. </p> 
                                                        </div>
                                                        <div class="wish-icon-hover-list text-left clearfix">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                            </ul> 
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="single-product shop-list mb-48">
                                            <div class="single-product-item clearfix">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                                        <div class="single-product-img clearfix">
                                                            <a href="#">
                                                                <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/3.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                                        <div class="single-product-info mt-20 clearfix">
                                                            <h3><a href="#">Eletria postma</a></h3>
                                                            <div class="pro-rating">  
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div> 
                                                            <div class="pro-price">
                                                                <span class="new-price">$160</span>
                                                                <span class="old-price">$190</span>
                                                            </div> 
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris    nisi ut aliquip reprehenderit. </p> 
                                                        </div>
                                                        <div class="wish-icon-hover-list text-left clearfix">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                            </ul> 
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="single-product shop-list mb-48">
                                            <div class="single-product-item clearfix">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                                        <div class="single-product-img clearfix">
                                                            <a href="#">
                                                                <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/4.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="new-sale list">
                                                            <span class="black">new</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                                        <div class="single-product-info mt-20 clearfix">
                                                            <h3><a href="#">Eletria postma</a></h3>
                                                            <div class="pro-rating">  
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div> 
                                                            <div class="pro-price">
                                                                <span class="new-price">$120</span>
                                                                <span class="old-price">$140</span>
                                                            </div> 
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris    nisi ut aliquip reprehenderit. </p> 
                                                        </div>
                                                        <div class="wish-icon-hover-list text-left clearfix">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                            </ul> 
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="single-product shop-list mb-48">
                                            <div class="single-product-item clearfix">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                                        <div class="single-product-img clearfix">
                                                            <a href="#">
                                                                <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/5.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="new-sale list">
                                                            <span class="black">new</span>
                                                            <span class="red">sale</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                                        <div class="single-product-info mt-30 clearfix">
                                                            <h3><a href="#">Eletria postma</a></h3>
                                                            <div class="pro-rating">  
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <span>1 Review(s)</span>
                                                            </div> 
                                                            <div class="pro-price">
                                                                <span class="new-price">$150</span>
                                                                <span class="old-price">$180</span>
                                                            </div> 
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris    nisi ut aliquip reprehenderit. </p> 
                                                        </div>
                                                        <div class="wish-icon-hover-list text-left clearfix">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                            </ul> 
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="single-product shop-list mb-48">
                                            <div class="single-product-item clearfix">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                                        <div class="single-product-img clearfix">
                                                            <a href="#">
                                                                <img class="primary-image" src="<?=Yii::$app->homeUrl?>img/product/6.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="new-sale list">
                                                            <span class="black">new</span>
                                                            <span class="red">sale</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                                        <div class="single-product-info mt-30 clearfix">
                                                            <h3><a href="#">Eletria postma</a></h3>
                                                            <div class="pro-rating">  
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <span>1 Review(s)</span>
                                                            </div> 
                                                            <div class="pro-price">
                                                                <span class="new-price">$150</span>
                                                                <span class="old-price">$180</span>
                                                            </div> 
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris    nisi ut aliquip reprehenderit. </p> 
                                                        </div>
                                                        <div class="wish-icon-hover-list text-left clearfix">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" title="Shopping Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                                <li><a class="modal-view" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Compage"><i class="fa fa-refresh"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" title="Like it!"><i class="fa fa-heart"></i></a></li>
                                                            </ul> 
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>      
                                </div>
                            </div>
                            </div> 
                        </div> 
                        <div class="row">  
                            <div class="shop-item-filter mb-25">
                                <div class="col-lg-4 col-md-3 col-sm-5 col-xs-5">
                                    <div class="shop-tab clearfix">
                                        <!-- Nav tabs -->
                                        <ul role="tablist">
                                            <li role="presentation" class="active"><a data-toggle="tab" role="tab" aria-controls="grid" class="grid-view" href="#grid"><i class="fa fa-th"></i></a></li>
                                            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list" class="list-view" href="#list"><i class="fa fa-list"></i></a></li>
                                        </ul>
                                    </div>
                                </div>    
                                <div class="col-lg-4 col-md-5 hidden-sm hidden-xs">      
                                    <div class="filter-by">
                                        <h4>Short by: </h4>
                                        <form action="#">
                                            <div class="select-filter">
                                                <select>
                                                  <option value="color">Position</option>
                                                  <option value="name">Name</option>
                                                  <option value="brand">Brand</option>
                                                </select> 
                                            </div>
                                        </form>								
                                    </div>
                                    <div class="filter-by">
                                        <h4>Show: </h4>
                                        <form action="#">
                                            <div class="select-filter">
                                                <select>
                                                  <option value="10">12</option>
                                                  <option value="20">16</option>
                                                  <option value="30">20</option>
                                                </select> 
                                            </div>
                                        </form>	
                                    </div>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
                                    <div class="page-menu float-right">     
                                        <ul>
                                            <li class="li-page">page: </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li class="hidden-xs"><a href="#">3</a></li>
                                            <li class="hidden-xs"><a href="#">4</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>

                                </div>    
                            </div>
                        </div>  
                    </div>
                </div> 
                <!-- shop end --> 