<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductCate */

$this->title = 'Thêm mới danh mục sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Product Cates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-cate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
    ]) ?>

</div>
