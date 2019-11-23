<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\CategoryHome */

$this->title = 'Update Category Home: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Category Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-home-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataLinkCat' => $dataLinkCat,
    ]) ?>

</div>
