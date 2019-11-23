<?php use yii\helpers\Html; ?>
<div class="navbar-default sidebar" role="navigation">
   <div class="sidebar-nav navbar-collapse slimscrollsidebar">
      <ul class="nav" id="side-menu">
         <li class="sidebar-search hidden-sm hidden-md hidden-lg">
            <!-- input-group -->
            <div class="input-group custom-search-form">
               <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
               <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
               </span> 
            </div>
            <!-- /input-group -->
         </li>
         <li class="user-pro">
            <a href="#" class="waves-effect"><img src="<?= Yii::$app->homeUrl?>plugins/images/users/d1.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"><?= \Yii::$app->user->identity->username ?><span class="fa arrow"></span></span>
            </a>
            <ul class="nav nav-second-level">
               
               <li><a href="<?= Yii::$app->homeUrl.'user/changepassword' ?>"><i class="ti-settings"></i> Đổi Password</a></li>
               <?php if ($roleName=='admin'): ?>
               <li><a href="<?= Yii::$app->homeUrl ?>user"><i class="ti-settings"></i> Account Setting</a></li>
               <?php endif ?>
               <li><?= Html::a('<i class="fa fa-power-off"></i> Logout', Yii::$app->request->hostInfo.'/backend/site/logout',['data-method' => 'post']) ?></li>
            </ul>
         </li>
         
         <li>
            <a href="javascript:void(0);" class="waves-effect"><i class="icon-people p-r-10"></i> <span class="hide-menu"> Quản lý tin <span class="fa arrow"></span></span></a>
            <ul class="nav nav-second-level">
               <li> <a href="<?= Yii::$app->homeUrl ?>quanlytin/news">Tin tức</a> </li>
               <?php if ($roleName=='admin'): ?>
               <li> <a href="<?= Yii::$app->homeUrl ?>quanlytin/categories">Danh mục tin</a> </li>
               <?php endif ?>
               <li> <a href="<?= Yii::$app->homeUrl ?>quanlytin/videos">Video Manager</a> </li>
            </ul>
         </li>
         <?php if ($roleName=='admin'): ?>
         <li>
            <a href="tables.html" class="waves-effect"><i data-icon="O" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Setting<span class="fa arrow"></span></span></a>
            <ul class="nav nav-second-level">
               <li><a href="<?= Yii::$app->homeUrl ?>setting/banner/update?id=1">Quản lý Banner</a></li>
               <li><a href="<?= Yii::$app->homeUrl ?>setting/menu">Quản lý Menu</a></li>
               <li><a href="<?= Yii::$app->homeUrl ?>setting/setting-modules">Quản lý Modules</a></li>
               <li><a href="<?= Yii::$app->homeUrl ?>setting/setting/update?id=1">Thông tin trang</a></li>
            </ul>
         </li>
         <?php endif ?>
         
         <li><?= Html::a('<i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span>', Yii::$app->request->hostInfo.'/backend/site/logout',['data-method' => 'post']) ?></li>
      </ul>
   </div>
</div>