<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\Categories */

$this->title = 'Thêm mới danh mục tin';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
    ]) ?>

</div>
