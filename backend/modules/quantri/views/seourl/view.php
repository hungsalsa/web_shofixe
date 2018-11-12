<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\SeoUrl */

$this->title = $model->seo_url_id;
$this->params['breadcrumbs'][] = ['label' => 'Seo Urls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-url-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->seo_url_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->seo_url_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'seo_url_id:url',
            'language_id',
            'query',
            'slug',
        ],
    ]) ?>

</div>
