<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductDiary */

$this->title = 'Create Product Diary';
$this->params['breadcrumbs'][] = ['label' => 'Product Diaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-diary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
