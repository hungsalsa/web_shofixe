<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::$app->homeUrl ?>plugins/images/favicon.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register" style="margin: 50px auto;width:90%">
        <div class="col-md-6">
            <img width="100%" src="<?= Yii::$app->homeUrl ?>plugins/images/login-register.jpg">
        </div>
        <div class="login-box login-sidebar col-md-6" style="width:100%">
            <div class="white-box">
                
                <?= $content ?>
            </div>
        </div>
    </section>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
