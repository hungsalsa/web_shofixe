<?php use yii\helpers\Html; $user = Yii::$app->user->identity;?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="<?= Yii::$app->homeUrl ?>">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="<?= Yii::$app->homeUrl ?>plugins/images/admin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="<?= Yii::$app->homeUrl ?>plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><img src="<?= Yii::$app->homeUrl ?>plugins/images/logo-moto.png" alt="home" class="dark-logo" style="height:50px"/><!--This is light logo text--><img src="<?= Yii::$app->homeUrl ?>plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-gmail"></i>
                            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">You have 4 new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <a href="#">
                                        <div class="user-img"> <img src="<?= Yii::$app->homeUrl ?>plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="<?= Yii::$app->homeUrl ?>plugins/images/users/sonu.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="<?= Yii::$app->homeUrl ?>plugins/images/users/arijit.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="<?= Yii::$app->homeUrl ?>plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- .Task dropdown -->
                    <?php 
                    // dbg($data);

                    $urlchuyen = Yii::$app->homeUrl.'sanpham/chuyenkho';
                    if ($user->manager ==1 && isset($data['phieuchuyen'])) {
                        $countchuyen = $data['phieuchuyen'];
                        $urlchuyen = Yii::$app->homeUrl.'sanpham/chuyenkho';
                    }
                    if ($data['total'] > 0) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-check-circle"></i>
                            <div class="notify"><span class="heartbit"><?= $data['total'] ?></span><span class="point"></span></div>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                            <li>
                                <div class="drop-title">Bạn có tổng <?= $data['total'] ?> phiếu chuyển nội bộ chưa hoàn thành</div>
                            </li>
                            <?php if (isset($data['luutam'])): ?>
                                <?php foreach ($data['luutam'] as $value): ?>
                                    <li>
                                        <a href="<?= Yii::$app->homeUrl ?>sanpham/chuyenkho/xuatkho">
                                            <div>
                                                <p> <strong><?= $value['message'] ?> </strong> <span class="pull-right text-muted"><?= $value['count']/$data['total']*100 ?>% Complete</span> </p>
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value['count']/$data['total']*100 ?>%"> <span class="sr-only">40% Complete (success)</span> </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                                <li class="divider"></li>
                            <?php endif ?>
                            
                            <?php if (isset($data['chuyendi'])): ?>
                                <?php foreach ($data['chuyendi'] as $value): ?>
                                <li>
                                    <a href="<?= Yii::$app->homeUrl ?>sanpham/chuyenkho/xuatkho">
                                        <div>
                                            <p> <strong><?= $value['message'] ?> </strong> <span class="pull-right text-muted"><?= $value['count']/$data['total']*100 ?>% Complete</span> </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value['count']/$data['total']*100 ?>%"> <span class="sr-only">20% Complete</span> </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach ?>
                            <li class="divider"></li>
                            <?php endif ?>
                            
                            <?php if (isset($data['chuyenden'])): ?>
                                <?php foreach ($data['chuyenden'] as $value): ?>
                                    <li>
                                        <a href="<?= Yii::$app->homeUrl ?>sanpham/chuyenkho/nhapkho">
                                            <div>
                                                <p> <strong><?= $value['message'] ?></strong> <span class="pull-right text-muted"><?= $value['count']/$data['total']*100 ?>% Complete</span> </p>
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?= $value['count']/$data['total']*100 ?>%"> <span class="sr-only">20% Complete</span> </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                                <li class="divider"></li>
                            <?php endif ?>
                            <!-- <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a>
                            </li> -->
                        </ul>
                    </li>
                    <?php endif ?>
                    <?php if (isset($data['dichvu'])): ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-check-circle"></i>
                            <div class="notify"><span class="heartbit"><?= (isset($data['dichvu']))? $data['dichvu']:'' ?></span><span class="point"></span></div>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Có <?= (isset($data['dichvu']))? $data['dichvu']:'' ?> phiếu dịch vụ chưa xuất</strong></p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 2</strong> <span class="pull-right text-muted">20% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 3</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif ?>
                    <!-- .Megamenu -->
                    <?php 
                    if (in_array($roleName,['admin','manager','author'])):?>
                    <li class="mega-dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs">Quick Action</span> <i class="icon-options-vertical"></i></a>
                        <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                            <li class="col-sm-2">
                                <ul>
                                    <li class="dropdown-header">Thêm mới </li>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Thêm khách hàng', Yii::$app->homeUrl.'khachhang/khachhang/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php if (Yii::$app->user->can('khachhang/danhsachdichvu/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Thêm dịch vụ', Yii::$app->homeUrl.'khachhang/danhsachdichvu/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('quantri/motorbike/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Xe', Yii::$app->homeUrl.'quantri/motorbike/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('quantri/hangxe/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Hãng xe', Yii::$app->homeUrl.'quantri/hangxe/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('chi/khoanchi/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Khoản chi chi', Yii::$app->homeUrl.'chi/khoanchi/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('chi/loaichi/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Loại chi', Yii::$app->homeUrl.'chi/loaichi/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('quantri/unit/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Đơn vị tính', Yii::$app->homeUrl.'quantri/unit/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('quantri/employee/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Nhân viên', Yii::$app->homeUrl.'quantri/employee/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('sanpham/productcate/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Danh mục sản phẩm', Yii::$app->homeUrl.'sanpham/productcate/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('sanpham/product/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Sản phẩm', Yii::$app->homeUrl.'sanpham/product/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('sanpham/manufacture/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Nhà sản xuất', Yii::$app->homeUrl.'sanpham/manufacture/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('quantri/supplier/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Nhà cung cấp', Yii::$app->homeUrl.'quantri/supplier/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                </ul>
                            </li>
                           
                            <li class="col-sm-2">
                                <ul>
                                    <li class="dropdown-header">Luân chuyển</li>
                                    <?php if (Yii::$app->user->can('chi/chingay/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Chi Gia công - PT lẻ', Yii::$app->homeUrl.'chi/chingay/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('sanpham/chuyenkho/create')): ?>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Xuất nội bộ', Yii::$app->homeUrl.'sanpham/chuyenkho/create',['data-method' => 'post','target'=>'_blank']) ?> </li>
                                    <?php endif ?>
                                    <hr>
                                    
                                </ul>
                            </li>
                            <li class="col-sm-2">
                                <ul>
                                    <li class="dropdown-header">Xử lý</li>
                                    <?php if (Yii::$app->user->can('chi/thongke/index')): ?>
                                    <li><a href="<?= Yii::$app->homeUrl ?>chi/thongke">Thống kê chi</a></li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('khachhang/thongkexe/index')): ?>
                                    <li><a href="<?= Yii::$app->homeUrl ?>khachhang/thongkexe">Tra cứu khách hàng</a></li>
                                    <?php endif ?>
                                    <!-- <li><a href="<?= Yii::$app->homeUrl ?>sanpham/nxt">Thống kê NXT trực tiếp</a></li> -->
                                    <?php if (Yii::$app->user->can('common/tksanpham/index')): ?>
                                    <li><a href="<?= Yii::$app->homeUrl ?>common/tksanpham">Thống kê kho</a></li>
                                    <?php endif ?>
                                </ul>
                            </li>
                            <?php if ($user->id==1): ?>
                            <li class="col-sm-2">
                                <ul>
                                    <li class="dropdown-header">Tác vụ quản lý</li>
                                    <?php if (Yii::$app->user->can('khachhang/nhanbankh/capnhatdichvu')): ?>
                                    <li><a href="<?= Yii::$app->homeUrl ?>khachhang/nhanbankh/capnhatdichvu">Cập nhật trạng thái dịch vụ</a></li>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->can('khachhang/danhsachdichvu/nhanban')): ?>
                                    <li><a href="<?= Yii::$app->homeUrl ?>khachhang/danhsachdichvu/nhanban">Nhân bản dịch vụ từ sản phẩm</a></li>
                                    <?php endif ?>
                                </ul>
                            </li>
                        <?php endif ?>
                        </ul>
                    </li>
                    <?php else: ?>
                        <li class="mega-dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs">Quick Action</span> <i class="icon-options-vertical"></i></a>
                        <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                            <li class="col-sm-2">
                                <ul>
                                    <li class="dropdown-header">Thêm mới </li>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Thêm khách hàng', Yii::$app->homeUrl.'khachhang/khachhang/create',['target'=>'_blank']) ?> </li>
                                </ul>
                            </li>
                            <li class="col-sm-2">
                                <ul>
                                    <li class="dropdown-header">Danh mục</li>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Danh sách khách hàng', Yii::$app->homeUrl.'khachhang/khachhang',['target'=>'_blank']) ?> </li>
                                    <li> <?= Html::a('<i class="fa fa-power-off"></i> Tra cứu khách hàng', Yii::$app->homeUrl.'khachhang/thongkexe',['target'=>'_blank']) ?> </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </li>
                    <?php endif ?>
                    <!-- /.Megamenu -->
                </ul>
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="<?= Yii::$app->homeUrl ?>khachhang/thongkexe" class=""><i class=" ti-search"></i> Tìm kiếm khách hàng</a></li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>
                     -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?= Yii::$app->homeUrl ?>plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php $user = Yii::$app->user->identity; echo $user->username ?></b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?= Yii::$app->homeUrl ?>plugins/images/users/varun.jpg" alt="user" /></div>
                                    <div class="u-text">
                                        <h4><?php $user = Yii::$app->user->identity; echo $user->fullname ?></h4>
                                        <p class="text-muted">varun@gmail.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>user/changepassword"><i class="ti-user"></i> Đổi mật khẩu</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>user"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <?= Html::a('<i class="fa fa-power-off"></i> Logout', Yii::$app->request->hostInfo.'/backend/site/logout',['data-method' => 'post']) ?>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>