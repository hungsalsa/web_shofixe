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
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last',
            'prevPageLabel' => '<i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i>',
            'nextPageLabel' => '<i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>',
            'maxButtonCount' => 5,
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} tin",
        'tableOptions' => ['class' => 'table table-bordered table-hover','id'=>'newIndex'],
        // 'rowOptions' => function ($model, $key, $index, $grid) {
        //     return [
        //         'style' => "cursor: pointer",
        //         'id' => $model['id'], 
        //         'onclick' => 'location.href="'
        //         . Yii::$app->urlManager->createUrl('quanlytin/news/update')
        //         . '?id="+(this.id);',
        //     ];
        // },
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
              'contentOptions' => ['width'=>'9%'],
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
            [
                'attribute'=>'name',
                'format'=>'html',
                'contentOptions'=>['class'=>'NewName'],
                'value'=>function($data)
                {
                    return Html::a($data->name,['update','id'=>$data->id], ['alt'=>$data['seo_title'],'class'=>'nameItem']);
                },
            ],
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
                'attribute' =>'sort',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('sort', $model->sort, ['max' => 998,'class'=>'form-control col-md-4','id'=>'sort'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savesort',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/quanlytin/news/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                "</div>";
                    return Html::button($model->sort,$options = [
                        'data-field'=>'sort',
                        'data-id'=>$key,
                        'id'=>'buttonsort'.$key,
                        'class'=>'btn btn-outline-success m-b-20 Quickchange change',
                    ]).$html;
                },
            ],
            [
                'attribute' => 'created_at',
                'contentOptions' => ['class' => 'text-center','style' => 'width:10.4%'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            // 'status',
            [
                'attribute'=>'status',
                'contentOptions' => ['class' => 'text-center','style' => 'width:5%'],
                'value'=>function($data){
                    return ($data->status == 1)? " Yes ":" No ";
                }
            ],
            [
                'attribute'=>'user_add',
                'contentOptions' => ['class' => 'text-center','style' => 'width:5%'],
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
<?php $this->registerJsFile('@web/js/news/news_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>