<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\NewImages */

$this->title = 'Update New Images: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'New Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_image, 'url' => ['view', 'id' => $model->id_image]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="new-images-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
