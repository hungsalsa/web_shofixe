<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\ProductCategory */

$this->title = 'Cập nhật : '.$model->cateName;
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->idCate]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-category-update">

    <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
        'dataGroup' => $dataGroup,
    ]) ?>

</div>
