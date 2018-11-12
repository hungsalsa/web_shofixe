<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\SeoUrl */

$this->title = 'Update Seo Url: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Seo Urls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->seo_url_id, 'url' => ['view', 'id' => $model->seo_url_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="seo-url-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
