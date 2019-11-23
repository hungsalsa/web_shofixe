<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\setting\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Tạo menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} danh mục",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('setting/menu/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header'=>' STT '],

            // 'id',
            'name',
            // 'title',
            [
                'attribute'=>'link_cate',
                'value'=>'category.cateName'
            ],
            // 'slug',
            // 'type',
            //'introduction:ntext',
            //'parent_id',
            [
                'attribute'=>'order',
                'contentOptions' => ['style' => 'width: 6%','class'=>'text-center'],
            ],
            /*[
                'attribute' =>'order',
                'headerOptions' => ['width' => '20%'],
                'contentOptions' => ['class' => ' text-center'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('order', $model->order, ['class'=>'form-control col-md-4','id'=>'order'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 saveorder','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-5 m-3 Cancel','style'=>'margin:2px']).
                    
                "</div>";
                    return Html::tag('span',($model->order == "") ? "Chưa có " :$model->order,
                    $options = [
                        'data-field'=>'order',
                        'data-id'=>$key,
                        'id'=>'buttonorder'.$key,
                        'class'=>'text-info m-b-20 Quickchange change',
                    ]).$html;
                },
            ],*/
            //'image',
            //'mega',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'attribute' => 'updated_at',
                'contentOptions' => ['style' => 'width: 11%','class'=>'text-center'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute'=>'user_id',
                'contentOptions' => ['class' => 'text-center','style' => 'width:7%'],
                'value'=>'userad.username'
            ],
            //'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn','style' => 'font-size:18px'],
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('setting/menu/update'),
                    'delete' => Yii::$app->user->can('setting/menu/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php $this->registerJsFile('@web/js/menu/menu_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>