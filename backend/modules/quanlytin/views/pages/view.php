<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\quantri\models\Product;
use backend\modules\quantri\models\News;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Pages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa trang', ['delete', 'id' => $model->id], [
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
            'title',
            'slug',
            
            // 'status',
            [
                'attribute' => 'status',
                'value'=>function($data){
                    if($data->status==1){
                        return "Kích hoạt";
                    }else{
                        return "Không kích hoạt";
                    }
                },
                // 'headerOptions' => ['class' => 'text-center'],
                'label' => 'Trạng thái',
            ],
            [
                'attribute' => 'tag_product',
                'value'=>function($data){
                    $tag = json_decode($data->tag_product);
                    if(count($tag)){
                        $product = new Product();
                        $dataProduct = $product->getAllPro();
                        $tag_pro='';
                        foreach ($tag as $value) {
                            $tag_pro .= $dataProduct[$value].';';
                        }
                        return $tag_pro;
                    }else {
                        return '';
                    }
                        
                },
                // 'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'tag_news',
                'value'=>function($data){
                    $tag = json_decode($data->tag_news);
                    if(count($tag)){
                        $news = new News();
                        $dataNews = $news->getAllNews();
                        $tag_new='';
                        foreach ($tag as $value) {
                            $tag_new .= $dataNews[$value].';';
                        }
                        return $tag_new;
                    }else {
                        return '';
                    }
                        
                },
                // 'headerOptions' => ['class' => 'text-center'],
            ],
            'keywords',
            'description:ntext',
            [
                'attribute' => 'short_introduction',
                'format' => ['html']
            ],
            // 'content:ntext',
            // [
            //     'attribute' => 'content',
            //     'value'=>$model->content,
            //     'format' => ['html'],
            //     'contentOptions' => ['class' => 'text-center','style'=>'height:180px'],
            // ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            'user_id',
        ],
    ]) ?>

</div>
