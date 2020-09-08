<?php use yii\helpers\Html; ?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
            <ul class="nav" id="side-menu">
                <li class="user-pro">
                    <a href="javascript:void(0)" class="waves-effect"><img src="<?= Yii::$app->homeUrl ?>plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"> <?= (getUser()->fullname != '') ? getUser()->fullname : getUser()->username ?><span class="fa arrow"></span></span>
                    </a>
                    <ul class="nav nav-second-level" aria-expanded="false" style="height: 0px;">
                        <li><a href="javascript:void(0)"><i class="ti-user"></i> <span class="hide-menu">My Profile</span></a></li>
                        <?php if ($roleName == 'admin'): ?>
                            <li><a href="<?= Yii::$app->homeUrl ?>user"><i class="ti-wallet"></i> <span class="hide-menu">User Manager</span></a></li>
                        <?php endif ?>
                        <li><a href="<?= Yii::$app->homeUrl ?>user/changepassword"><i class="ti-settings"></i> <span class="hide-menu">Đổi mật khẩu</span></a></li>
                        <li>
                            <?= Html::a('<i class="fa fa-power-off"></i>  <span class="hide-menu">Logout</span>', Yii::$app->request->hostInfo.'/backend/site/logout',['data-method' => 'post']) ?>
                        </li>
                    </ul>
                </li>
                <li class="devider"></li>
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="icon-people fa-fw"></i> <span class="hide-menu">QL Khách hàng<span class="fa arrow"></span><span class="label label-rouded label-warning pull-right">30</span></span></a>
                	<ul class="nav nav-second-level">
                		<li><a href="<?= Yii::$app->homeUrl ?>khachhang/thongkexe"><i class="ti-search"></i> <span class="hide-menu">Tra cứu thống kê</span></a></li>
                		<li><a href="<?= Yii::$app->homeUrl ?>khachhang/khachhang"><i class="mdi mdi-database-plus"></i> <span class="hide-menu">Khách hàng</span></a></li>
                		<li><a href="<?= Yii::$app->homeUrl ?>dichvukhachhang"><i class="ti-layout-sidebar-left fa-fw"></i> <span class="hide-menu">Dịch vụ KH</span></a></li>
                		<li><a href="<?= Yii::$app->homeUrl ?>khachhang/danhsachdichvu"><i class="ti-list-ol"></i> <span class="hide-menu">Danh sách dịch vụ</span></a></li>
                		<?php if ($roleName == 'manager' || $roleName == 'admin'): ?>
                			<li><a href="javascript:void(0)" class="waves-effect"><i class="ti-desktop fa-fw"></i><span class="hide-menu">Quản lý</span><span class="fa arrow"></span></a>
                				<ul class="nav nav-third-level collapse">
                					<li><a href="<?= Yii::$app->homeUrl ?>khachhang/danhsachdichvu/suanhanh"><i class="ti-list-ol"></i> <span class="hide-menu">Sửa nhanh dịch vụ</span></a></li>
                					<li><a href="<?= Yii::$app->homeUrl ?>nhanbandichvu"><i class="ti-server"></i> <span class="hide-menu">Nhân bản phụ tùng=>dịch vụ</span></a></li>
                					<li><a href="<?= Yii::$app->homeUrl ?>khachhang/nhanbankh/capnhatdichvu"><i class=" ti-layout-media-center-alt"></i> <span class="hide-menu">Cập nhật dịch vụ KH</span></a></li>
                					<?php if ($roleName == 'admin'): ?>
                						<li><a href="<?= Yii::$app->homeUrl ?>khachhang/danhsachdichvu/edit"><i class="ti-list-ol"></i> <span class="hide-menu">Sửa nhanh dịch vụ Kartik</span></a></li>
                						<li><a href="<?= Yii::$app->homeUrl ?>sanpham/nhanban"><i class="ti-server"></i> <span class="hide-menu">Nhân bản phụ tùng=>Cửa hàng</span></a></li>
                					<?php endif ?>
                				</ul>
                			</li>
                		<?php endif ?>
                	</ul>
                </li>
                <li class="devider"></li>

                <li> <a href="javascript:void(0)" class="waves-effect"><i style="font-size: 21px;" class="icon icon-diamond" data-icon="v"></i> <span class="hide-menu"> Chuyển nội bộ <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right">4</span></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($roleName == 'admin'): ?>
                            <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/chuyenkho"><i class="fa fa-truck fa-fw"></i><span class="hide-menu">Danh sách chuyển</span></a> </li>
                        <?php endif ?>
                        <?php if (Yii::$app->user->can('sanpham/chuyenkho/xuatkho')): ?>
                        <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/chuyenkho/xuatkho"><i class="ti-car"></i><span class="hide-menu"> Xuất nội bộ</span></a> </li>
                        <?php endif ?>
                        <?php if (Yii::$app->user->can('sanpham/chuyenkho/nhapkho')): ?>
                        <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/chuyenkho/nhapkho"><i class="fa fa-taxi fa-fw"></i><span class="hide-menu">Nhập nội bộ</span></a> </li>
                        <?php endif ?>
                    </ul>
                </li>
                <li> <a href="javascript:void(0)" class="waves-effect"><i style="font-size: 21px;" class="fa fa-product-hunt" data-icon="v"></i> <span class="hide-menu"> Sản phẩm <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right">4</span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/product"><i class="fa fa-money fa-fw"></i><span class="hide-menu">Danh sách sản phẩm</span></a> </li>
                        <?php if (Yii::$app->user->can('sanpham/product/suanhanh')): ?>
                                    <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/product/suanhanh"><i class="fa fa-spin fa-star-o"></i><span class="hide-menu"> Sửa nhanh sản phẩm</span></a> </li>
                        <?php endif ?>
                        <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/location"><i class="fa fa-outdent fa-fw"></i><span class="hide-menu">Vị trí sản phẩm</span></a> </li>
                        <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/productcate"><i class="fa fa-outdent fa-fw"></i><span class="hide-menu">Danh mục sản phẩm</span></a> </li>
                        <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/manufacture"><i class="fa fa-apple fa-fw"></i><span class="hide-menu">Nhà sản xuất</span></a> </li>
                        <li><a href="<?= Yii::$app->homeUrl ?>quantri/supplier"><i class="ti-alert fa-fw"></i> <span class="hide-menu">Nhà cung cấp</span></a></li>
                        
                        <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-desktop fa-fw"></i><span class="hide-menu">Quản lý</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse">
                                    <li><a href="<?= Yii::$app->homeUrl ?>common/tksanpham"><i class="fa  fa-empire"></i><span class="hide-menu"> Thống kê Sản phẩm</span></a></li>
                                    <?php if ($roleName == 'admin'|| $roleName == 'manager'): ?>
                                    <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/product/updateproduct"><i class=" fa-fw">1</i><span class="hide-menu">Nhân bản phụ tùng</span></a> </li>
                                    <?php if ($roleName == 'admin'): ?>
                                        <li><a href="<?= Yii::$app->homeUrl ?>sanpham/product-motorbike"><i class="ti-list-ol"></i> <span class="hide-menu">Sản phẩm cho xe</span></a></li>
                                        <!-- <li><a href="<?= Yii::$app->homeUrl ?>sanpham/product/edit"><i class="ti-list-ol"></i> <span class="hide-menu">Sửa nhanh sản phẩm Kartik</span></a></li> -->
                                    <?php endif ?>
                                    <!-- <li> <a href="<?= Yii::$app->homeUrl ?>sanpham/product/suanhanh"><i class=" fa-fw">2</i><span class="hide-menu">Sửa nhanh sản phẩm</span></a> </li> -->
                                    <li><a href="<?= Yii::$app->homeUrl ?>suamasanpham"><i class="fa fa-barcode"></i> <span class="hide-menu">Sửa mã SP + Dịch vụ</span></a></li>
                                <?php endif ?>
                            </ul>
                        </li>
                        
                    </ul>
                </li>
                <li class="devider"></li>
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="ti-shopping-cart-full text-primary" data-icon="v" style="font-size: 16px"></i> <span class="hide-menu"> Quản lý chi <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right">4</span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?= Yii::$app->homeUrl ?>chi/chingay"><i class="fa-fw">1</i><span class="hide-menu">Chi hàng ngày</span></a> </li>
                        <li> <a href="<?= Yii::$app->homeUrl ?>chi/thongke"><i class=" fa-fw">3</i><span class="hide-menu">Thống kê</span></a> </li>
                        <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-desktop fa-fw"></i><span class="hide-menu">Khác</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse">
                                <li> <a href="<?= Yii::$app->homeUrl ?>chi/loaichi"><i class=" fa-fw">4</i><span class="hide-menu">Loại chi</span></a> </li>
                                <li> <a href="<?= Yii::$app->homeUrl ?>chi/khoanchi"><i class=" fa-fw">5</i><span class="hide-menu">DS Khoản chi</span></a> </li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-desktop fa-fw"></i><span class="hide-menu">Danh mục khác</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse">
                                <li> <a href="<?= Yii::$app->homeUrl ?>chi/vattutieuhao"><i class=" fa-fw">5</i><span class="hide-menu">Vật tư tiêu hao</span></a> </li>
                                <li> <a href="<?= Yii::$app->homeUrl ?>chi/dungcu-thietbi"><i class=" fa-fw">5</i><span class="hide-menu">Danh sách dụng cụ, thiết bị</span></a> </li>
                                <?php if ($roleName == 'admin'): ?>
                                    <li> <a href="<?= Yii::$app->homeUrl ?>chi/chitietchi"><i class=" fa-fw">7</i><span class="hide-menu">Chi tiết chi</span></a> </li>
                                    <li> <a href="<?= Yii::$app->homeUrl ?>nhanbankhoanchi"><i class=" fa-fw">6</i><span class="hide-menu">Nhân bản khoản chi</span></a> </li>
                                <?php endif ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="devider"></li>
                
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-laptop-mac"></i> <span class="hide-menu">Quản lý phiếu<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= Yii::$app->homeUrl ?>phieu/phieugiao"><i class="fa-fw">G</i><span class="hide-menu">Giao phiếu</span></a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>phieu/sophieu"><i class="fa-fw">S</i><span class="hide-menu">Số phiếu</span></a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>phieu/phieusudung"><i class="fa-fw">SD</i><span class="hide-menu">Sử dụng phiếu</span></a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>phieu/phieuthieu"><i class="fa-fw">T</i><span class="hide-menu">Phiếu thiếu</span></a></li>
                        <!-- <li><a href="<?= Yii::$app->homeUrl ?>phieu/phieuton"><i class="fa-fw">T</i><span class="hide-menu">Phiếu tồn</span></a></li> -->
                        
                    </ul>
                </li>
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="icon icon-bell"></i> <span class="hide-menu">Quản lý chung<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">20</span> </span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= Yii::$app->homeUrl ?>quantri/unit"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Đơn vị tính</span></a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>quantri/hangxe"><i data-icon="&#xe025;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Hãng xe</span></a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>quantri/motorbike"><i class="ti-layout-menu fa-fw"></i> <span class="hide-menu">Các xe</span></a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>quantri/employee"><i class="ti-alert fa-fw"></i> <span class="hide-menu">Nhân viên</span></a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>quantri/nhanvienlamviec"><i class="ti-alert fa-fw"></i> <span class="hide-menu">Nhân viên làm việc</span></a></li>
                        
                        <?php if (getUser()->manager==1): ?>
                            <li><a href="<?= Yii::$app->homeUrl ?>quantri/cuahang"><i class="ti-alert fa-fw"></i> <span class="hide-menu">Danh sách cửa hàng</span></a></li>
                        <?php endif ?>
                    </ul>
                </li>
                <li class="devider"></li>
                
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-table fa-fw"></i> <span class="hide-menu">Thống kê<span class="fa arrow"></span><span class="label label-rouded label-primary pull-right">9</span></span></a>
                    <ul class="nav nav-second-level">
                        
                        <li><a href="<?= Yii::$app->homeUrl ?>sanpham/nxt"><i class="fa-fw">L</i><span class="hide-menu">Thống kê NXT trực tiếp (lâu)</span></a></li>
                        <li><a href="<?= Yii::$app->homeUrl ?>sanpham/thongke"><i class="fa-fw">TK</i><span class="hide-menu">Thống kê</span></a></li>
                    </ul>
                </li>
                <li class="devider"></li>
                
                <?php if ($roleName == 'admin'): ?>
                    <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-chart-bar fa-fw"></i> <span class="hide-menu">Cập nhật & Nhân bản<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                                
                        </ul>
                    </li>
                <li class="devider"></li>
                <?php endif ?>
                
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-table fa-fw"></i> <span class="hide-menu">Doanh thu<span class="fa arrow"></span><span class="label label-rouded label-primary pull-right">9</span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?= Yii::$app->homeUrl ?>doanhthu/doanhthu"><i class=" fa-fw">5</i><span class="hide-menu">Doanh thu ngày</span></a> </li>
                    </ul>
                </li>
                <li class="devider"></li>
                
                <!-- <li> <a href="widgets.html" class="waves-effect"><i  class="mdi mdi-settings fa-fw"></i> <span class="hide-menu">Widgets</span></a> </li>
                
                <li> <a href="map-google.html" class="waves-effect"><i class="mdi mdi-google-maps fa-fw"></i><span class="hide-menu">Google Map</span></a> </li>
                <li> <a href="map-vector.html" class="waves-effect"><i class="mdi mdi-map-marker fa-fw"></i><span class="hide-menu">Vector Map</span></a> </li>
                <li> <a href="calendar.html" class="waves-effect"><i class="mdi mdi-calendar-check fa-fw"></i> <span class="hide-menu">Calendar</span></a></li>
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-checkbox-multiple-marked-outline fa-fw"></i> <span class="hide-menu">Multi-Level Dropdown<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="javascript:void(0)"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Second Level Item</span></a> </li>
                        <li> <a href="javascript:void(0)"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Second Level Item</span></a> </li>
                        <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Third Level </span><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li> <a href="javascript:void(0)"><i class=" fa-fw">T</i><span class="hide-menu">Third Level Item</span></a> </li>
                                <li> <a href="javascript:void(0)"><i class=" fa-fw">M</i><span class="hide-menu">Third Level Item</span></a> </li>
                                <li> <a href="javascript:void(0)"><i class=" fa-fw">R</i><span class="hide-menu">Third Level Item</span></a> </li>
                                <li> <a href="javascript:void(0)"><i class=" fa-fw">G</i><span class="hide-menu">Third Level Item</span></a> </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="login.html" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                <li class="devider"></li>
                <li><a href="documentation.html" class="waves-effect"><i class="fa fa-circle-o text-danger"></i> <span class="hide-menu">Documentation</span></a></li>
                <li><a href="gallery.html" class="waves-effect"><i class="fa fa-circle-o text-info"></i> <span class="hide-menu">Gallery</span></a></li>-->
                <li><a href="faq.html" class="waves-effect"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">Faqs</span></a></li> 
            </ul>
        </div>
    </div>