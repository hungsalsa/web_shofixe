<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\Motorbike;
use kartik\select2\Select2;
$this->title = 'Danh sách sản phẩm bạn quản lý';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <p class="pull-right btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Sản phẩm từ {begin} -> {end} trong tổng {totalCount} sản phẩm",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        // 'rowOptions' => function ($model, $key, $index, $grid) {
        //     return [
        //         'style' => "cursor: pointer",
        //         'onclick' => 'location.href="'
        //         . Yii::$app->urlManager->createUrl('sanpham/product/view?id='.$model->id).'"'
        //     ];
        // },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'idPro',
            // 'proName',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'proName',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->proName),Yii::$app->homeUrl.'sanpham/product/view?id='.$data->id);
                },

            ],
            [
                'attribute'=>'manu_id',
                'value'=>'nhasanxuat.manuName',
            ],
            [
                'attribute' => 'cuahang_id',
                'value'=>'cuahang.name',
            ],
            [
                'attribute'=>'cate_id',
                'value'=>'category.cateName',
            ],
            'guarantee',
            // [
            //     'attribute'=>'location',
            //     'value'=>'vitri.name',
            //     'contentOptions' => ['data-attribute' => 'location','class'=>'changeLocation change']
            // ],
            [
                'attribute' =>'location',
                // 'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use($data){
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Select2::widget([
                        'name' => 'location',
                        'value' => ($model->location == '') ? false:$model->location,
                        'data' => $data['location'],
                        'options' => [
                            'id'=>'location'.$key,
                            'placeholder' => 'Select provinces ...',
                        ],
                    ]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savelocation','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-5 m-3 Cancel','style'=>'margin:2px']).
                    "</div>";

                    return Html::tag('span',($model->location == 0) ? 'Chưa có' :$model->vitri->name,$options = [
                        'data-id'=>$key,
                        'data-field'=>'location',
                        'id'=>'buttonlocation'.$key,
                        'class'=>'text-info m-b-20 Quickchange change text-primary',
                    ]).$html;
                },
            ],
            // 'quantity',
            [
                'attribute' =>'price',
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('price', $model->price, ['type' => 'number','min' => 0,'class'=>'form-control col-md-4','id'=>'price'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savePrices','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
                    
                "</div>";
                    return Html::button(Yii::$app->formatter->asDecimal($model->price,0),$options = [
                        'data-field'=>'price',
                        'data-id'=>$key,
                        'id'=>'buttonPrice'.$key,
                        'class'=>'btn btn-default btn-outline m-b-20 Quickchange change',
                    ]).$html;
                },
            ],
            [
                'attribute' =>'price_sale',
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('price_sale', $model->price_sale, ['type' => 'number','min' => 0,'class'=>'form-control col-md-4','id'=>'price_sale'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savePrice_sale','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
                    
                "</div>";
                    return Html::button(Yii::$app->formatter->asDecimal($model->price_sale,0),$options = [
                        'data-field'=>'price_sale',
                        'data-id'=>$key,
                        'id'=>'buttonPrice_sale'.$key,
                        'class'=>'btn btn-default btn-outline m-b-20 Quickchange change',
                    ]).$html;
                },
            ],
            // 'note:ntext',
            [
                'attribute' =>'status',
                'value'=>function ($data)
                {
                    $status = [0=>' Hidden ',1 =>' Active '];
                    return $status[$data->status];
                }
            ],
            // [
            //     'attribute' => 'created_at',
            //     'format' => ['date', 'php:d-m-Y']
            // ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            //'created_at',
            //'updated_at',
            // [
            //     'attribute'=>'user_add',
            //     'value'=>'user.username',
            // ],
            [
                'attribute'=>'bike_id',
                'value'=>function ($data)
                {
                    $bike = new Motorbike();
                    return $bike->ReturnBikename(json_decode($data->bike_id));
                }
            ],
            
            //'cate_id',actionColumn
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{view} {update} {delete}',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('sanpham/product/view'),
                    'update' => Yii::$app->user->can('sanpham/product/update'),
                    'delete' => Yii::$app->user->can('sanpham/product/delete')
                ],
            ],
         

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php $this->registerJsFile('@web/js/product/product_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>

<?php 
// $ad122 = ['id'=>3,'proname'=>'dấda dấda'];
// (array_merge($ad122,['price'=>99999]));
// dbg($ad122);
 ?>
 <?php Html::dropDownList('category', [1, 3, 5], [1=>'adsadad',3=>'adadadad'], [
   // 'multiple' => 'multiple',
   'options' => [
        'value1' => ['disabled' => true, 'class' => 'yourClass', 'style'=> 'yourStyle',],
        'value2' => ['label' => 'value 2'],
    ]
]) ?>