<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductMotorbike */

$this->title = 'Update Product Motorbike: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Product Motorbikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-motorbike-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
