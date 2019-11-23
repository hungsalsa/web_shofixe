<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quanlytin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách tin tức';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} tin",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('quanlytin/news/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
        //     [
        //       'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($model) {
        //         return ['value' => $model->id];
        //     },
        // ],

            [
                'class' => 'yii\grid\SerialColumn',
                'header'=>'STT'
            ],

            // 'id',
            // 'slug',
            // 'images',
            [
              'attribute' => 'images',
              'format' => ['raw'],
              'contentOptions' => ['class' => 'text-center','width'=>'6%'],
              'value' => function ($data) 
              {
                $image = Yii::$app->request->hostinfo.'/'.$data->images;
                $file_image = Yii::getAlias('@uploading').'/'.$data->images;
                $file_image = str_replace("\\","/",$file_image);

                if ($data->images=='') {//dbg('DSADA');
                    $image = Yii::$app->request->hostinfo.'/tin-tuc/no-image.png';
                }
                
                return Html::img($image, ['alt'=>$data['seo_title'],'height'=>'50']);
                },
            ],
            'name',
            // 'image_category',
            //'image_detail',
            //'category_id',
            [
                'attribute'=>'category_id',
                'value'=>'danhmuc.cateName',
            ],
            //'seo_title',
            //'seo_keyword',
            //'seo_descriptions:ntext',
            //'short_description:ntext',
            //'content:ntext',
            // 'hot',
            // [
            //   'attribute' => 'hot',
            //   // 'format' => 'html',
            //   'value' => function ($data) 
            //   {
            //     if ($data->hot !='') {
            //         $hot = json_decode($data->hot);
            //         $hotname='';
            //         foreach ($hot as $value) {
            //             $hotname .= ($value==1) ? 'slider 2':'slider 1';
            //         }
            //     } else {
            //         $hot ='';
                    
            //     }
            //     dbg($hotname);
            //     return Html::img($url, ['alt'=>$data['seo_title'],'width'=>'70','height'=>'50']);
            //     },
            // ],
            //'view',
            //'popular',
            //'related_products',
            //'related_news',
            // 'updated_at',
            [
                'attribute' => 'sort',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
            ],
            [
                'attribute' => 'created_at',
                'contentOptions' => ['class' => 'text-center','style' => 'width:11%'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            // 'status',
            [
                'attribute'=>'status',
                'contentOptions' => ['class' => 'text-center','style' => 'width:7%'],
                'value'=>function($data){
                    return ($data->status == 1)? "Kích hoạt":" Ẩn ";
                }
            ],
            [
                'attribute'=>'user_add',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'value'=>'userad.username'
            ],
            // [
            //     'attribute'=>'user_edit',
            //     'value'=>'usered.username'
            // ],
            //'user_add',
            //'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn','style' => 'font-size:18px'],
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('quanlytin/news/update'),
                    'delete' => Yii::$app->user->can('quanlytin/news/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
