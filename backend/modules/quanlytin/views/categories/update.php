<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\Categories */

$this->title = 'Chỉnh sửa danh mục : '.$model->cateName;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->seo_title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
    ]) ?>

</div>
