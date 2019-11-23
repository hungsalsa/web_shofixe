<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\News */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'slug',
            'images',
            [
              'attribute' => 'images',
              'format' => 'image',
              'value' => function ($data) 
              {
                $url = Yii::$app->request->hostinfo.'/'.$data['images'];
                return Html::img($url, ['alt'=>$data['seo_title'],'width'=>'70','height'=>'50']);
              },
            ],
            'image_category',
            'image_detail',
            [
                'attribute'=>'category_id',
                'value'=>$model->danhmuc->cateName,
            ],
            'seo_title',
            'seo_keyword',
            'seo_descriptions:ntext',
            'short_description:html',
            // 'content:html',
            'hot',
            'view',
            'see_more',
            'popular',
            'related_products',
            'related_news',
            'sort',
            'status',
            [
                'attribute'=>'user_add',
                'value'=>$model->userad->username,
            ],
            [
                'attribute'=>'user_edit',
                'value'=>function($data)
                {
                    if ($data->user_edit =='') {
                        return 'Chưa sửa';
                    } else {
                        return $model->usered->username;
                    }
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
