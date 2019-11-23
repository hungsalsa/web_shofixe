<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quanlytin\models\VideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý Video';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} Video",
        'tableOptions' => ['class' => 'table table-bordered table-hover Video'],
        // 'rowOptions' => function ($model, $key, $index, $grid) {
        //     return [
        //         'style' => "cursor: pointer",
        //         'id' => $model['idVideo'], 
        //         'onclick' => 'location.href="'
        //         . Yii::$app->urlManager->createUrl('quanlytin/videos/update')
        //         . '?id="+(this.id);',
        //     ];
        // },
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header'=>'STT'
            ],

            // 'idVideo',
            [
                'attribute'=>'name',
                'format'=>'html',
                'contentOptions'=>['class'=>'NewName'],
                'value'=>function($data)
                {
                    return Html::a($data->name,['update','id'=>$data->idVideo], ['alt'=>$data['seo_title'],'class'=>'nameItem']);
                },
            ],
            [
                'attribute' => 'link',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center videoItem','width'=>'6%'],
                'value' => function ($data) 
                {
                    return '<iframe width="161" height="94" src="'.$data->link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                }
            ],
            [
                'attribute' =>'sort',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('sort', $model->sort, ['max' => 998,'class'=>'form-control col-md-4','id'=>'sort'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savesort',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/quanlytin/videos/quickchange']),'data-id'=>$key]).
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
            // 'slug',
            'seo_title',
            // 'seo_description',
            [
                'attribute' => 'created_at',
                'contentOptions' => ['class' => 'text-center','style' => 'width:10.4%'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'contentOptions' => ['class' => 'text-center','style' => 'width:5%'],
                'value'=>'userAdd.username'
            ],
            //'updated_at',
            //'user_add',
            //'user_edit',

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
<?php $this->registerJsFile('@web/js/news/videos_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>