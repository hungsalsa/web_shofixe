<?php
use yii\helpers\Html;
use kartik\grid\GridView;
// use kartik\grid\Module;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use backend\modules\sanpham\models\ProductCate;
use backend\model\RecordUtil;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sanpham\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
    <div class="">

    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'pjax'=>true,
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
            // ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'kartik\grid\SerialColumn'],
            // ['class' => 'kartik\grid\ActionColumn'],
            // 'id',
            'idPro',
            // [
            //     'class' => 'yii\grid\DataColumn',
            //     'attribute' => 'proName',
            //     'format' => 'raw',
            //     'value'=>function ($data) {
            //         return Html::a(Html::encode($data->proName),Yii::$app->homeUrl.'sanpham/product/update?id='.$data->id);
            //     },

            // ],
            [
               'class' => 'kartik\grid\EditableColumn',
               'attribute' => 'proName',
               'pageSummary' => true,
               'readonly' => false,
                   'value' => function($model){ return $model->proName; }, // assign value from getProfileCompany method
                   'editableOptions' => [
                    'header' => 'proName',
                    'size'=>'md',
                    'inputType' => kartik\editable\Editable::INPUT_TEXT,
                    'options' => [
                        'pluginOptions' => [
                       'name'=>'Product[proName]',

                        ]
                    ]
                ],
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
            [
               'class' => 'kartik\grid\EditableColumn',
               'attribute' => 'quantity',
               'pageSummary' => true,
               'readonly' => false,
               'format'=>['decimal',0],
               'value' => function($model){ return $model->quantity; }, // assign value from getProfileCompany method
               'editableOptions' => [
                'header' => 'quantity',
                'inputType' => Editable::INPUT_MONEY,
                'options' => [
                    'pluginOptions' => [
                    // 'placeholder' => 'Enter a valid amount...',NumberControl
                        'prefix' => 'Q',
                        // 'suffix' => ' VNĐ',
                        'thousands' => '.',
                        'decimal' => ',',
                        'precision' => 0
                   // 'name'=>'Product[quantity]',
                    ]
                ]
                ],
            ],
            [
               'class' => 'kartik\grid\EditableColumn',
               'attribute' => 'price',
               'pageSummary' => true,
               'readonly' => false,
               'format'=>['decimal',0],
               'value' => function($model){ return $model->price; }, // assign value from getProfileCompany method
               'editableOptions' => [
                'header' => 'price',
                'inputType' => Editable::INPUT_MONEY,
                'options' => [
                    'pluginOptions' => [
                    // 'placeholder' => 'Enter a valid amount...',
                        'prefix' => '$ ',
                        // 'suffix' => ' VNĐ',
                        'thousands' => '.',
                        'decimal' => ',',
                        'precision' => 0
                   // 'name'=>'Product[quantity]',
                    ]
                ]
                ],
            ],
            [
               'class' => 'kartik\grid\EditableColumn',
               'attribute' => 'status',
               'pageSummary' => true,
               'readonly' => false,
               'value' => function($model){ return $model->status; }, // assign value from getProfileCompany method
               'editableOptions' => [
                'header' => 'status',
                'inputType' => Editable::INPUT_DROPDOWN_LIST  ,
                'displayValueConfig'=> [
                    '0' => '<i class="fa fa-thumbs-down"></i> Hidden',
                    '1' => '<i class="fa fa-thumbs-up"></i> Active',
                ],
                'data' => [0 => 'Hidden', 1 => 'Active'],
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                ],
            ],
            // 'note:ntext',
            // 'status',
            // [
            //     'attribute' => 'status',
            //     'value' => ['backend\models\RecordUtil', 'getStatusValue']
            // ],
            // [
            //     'attribute' => 'created_at',
            //     'format' => ['date', 'php:H:i d-m-Y']
            // ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i  ->   d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>'user.username',
            ],
            //'bike_id',
            
            //'cate_id',
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              'headerOptions' => ['style' => 'color:#337ab7'],
              'template' => '{view}{update}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open mr-2"></span>', $url, [
                        'title' => Yii::t('app', 'lead-view'),
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil mr-2"></span>', $url, [
                        'title' => Yii::t('app', 'lead-update'),
                    ]);
                },
            // 'delete' => function ($url, $model) {
            //     return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
            //                 'title' => Yii::t('app', 'lead-delete'),
            //     ]);
            // }

            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                $arrayParams = ['id' => $model->id,'idPro' => $model->idPro,'cuahang_id'=>$model->cuahang_id];
                if ($action === 'view') {
                    $route = 'sanpham/product/view';
                    $params = array_merge([$route], $arrayParams);
                    $url =Yii::$app->urlManager->createUrl($params);

                    return $url;
                }

                if ($action === 'update') {
                    $route = 'sanpham/product/update';
                    $params = array_merge([$route], $arrayParams);
                    $url =Yii::$app->urlManager->createUrl($params);

                    return $url;
                }
            // if ($action === 'delete') {
            //     // $route = 'sanpham/product/delete';
            //     // $params = array_merge([$route], $arrayParams);
            //     // $url =Yii::$app->urlManager->createUrl($params);

            //     $url =Yii::$app->urlManager->createUrl('sanpham/product/delete?id='.$model->id);
            //     return $url;
            // }

            }
        ],


            // ['class' => 'yii\grid\ActionColumn'],
    ],

]); ?>
<?php Pjax::end(); ?>
</div>
<?php
// $this->registerJsFile("@web/js/ajaxchange.js");
// $this->registerJsFile(Yii::$app->request->baseUrl.'/js/ajaxchange.js',['depends' => [\yii\web\JqueryAsset::className()]]); 
?>
