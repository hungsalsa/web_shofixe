<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\widgets\preloaderWidget;
use backend\widgets\navbarWidget;
use backend\widgets\sidebarWidget;
use backend\widgets\footerNodialog;
use backend\modules\khachhang\models\KhDichvu;
// use backend\widgets\FooterWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="loading" data-textdirection="ltr">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::$app->homeUrl ?>plugins/images/favicon.png">
	
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <?php $this->head() ?>
</head>
<body class="fix-header">
<?php $this->beginBody() ?>

    <!-- Preloader --><!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?= navbarWidget::widget() ?>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?= sidebarWidget::widget() ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?= $content ?>
                <?= footerNodialog::widget() ?>
            </div>
        </div>
    </div>
    
<?php $this->endBody() ?>
<?php if(Yii::$app->session->hasFlash('messeage')): ?>
<script type="text/javascript">

	$.notify({
		icon: 'pe-7s-gift',
		message: "<?= Yii::$app->session->getFlash('messeage') ?>"

	},{
		type: 'info',
		timer: 90
	});
</script>
<?php endif; ?>

</body>
</html>
<?php $this->endPage() ?>
