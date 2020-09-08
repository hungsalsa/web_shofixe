<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductMotorbike */

$this->title = 'Create Product Motorbike';
$this->params['breadcrumbs'][] = ['label' => 'Product Motorbikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-motorbike-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
