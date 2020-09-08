<?php
use yii\helpers\Html;
use kartik\grid\GridView;
// use kartik\color\ColorInput;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use backend\modules\sanpham\models\ProductCate;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sanpham\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách sản phẩm bạn quản lý';
$this->params['breadcrumbs'][] = $this->title;
// dbg($data['manufacture']);
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

<?php
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'id',
    'idPro',
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'proName',
        'pageSummary' => true,
        'readonly' => false,
        'value' => function($model){ return $model->proName; }, // assign value from getProfileCompany method
        'editableOptions' => [
        'header' => 'Tên SP',
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
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'manu_id',
            'editableOptions' => [
                'size'=>'md',
                'pjaxContainerId'=>'product-offers-grid',
                'header' => 'nhà sản xuất',
                'inputType' => \kartik\editable\Editable::INPUT_SELECT2,
                'valueIfNull' => '<em>' . Yii::t('app', '(not set)') . '</em>',
                'displayValueConfig'=> $data['manufacture'],
                'options' => [
                    'data' => $data['manufacture'],
                    'options' => [
                        'placeholder' => Yii::t('app', 'Select a store ...'),
                            // 'multiple' => true,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                // 'formOptions' => [
                //         'action' => Url::to(['update-store-offer'])
                //     ],
            ],
            // 'refreshGrid'=>true,
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'cate_id',
            'editableOptions' => [
                    'size'=>'md',
                'pjaxContainerId'=>'product-offers-grid',
                'header' => 'danh mục sản phẩm',
                'inputType' => \kartik\editable\Editable::INPUT_SELECT2,
                'valueIfNull' => '<em>' . Yii::t('app', '(not set)') . '</em>',
                'displayValueConfig'=> $data['category'],
                'options' => [
                    'data' => $data['category'],
                    'options' => [
                        'placeholder' => Yii::t('app', 'Select a store ...'),
                            // 'multiple' => true,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                // 'formOptions' => [
                //         'action' => Url::to(['update-store-offer'])
                // ],
            ],
            'refreshGrid'=>true,
        ],

        [
            'attribute' => 'cuahang_id',
            'value'=>'cuahang.name',
        ],
        [
         'class' => 'kartik\grid\EditableColumn',
         'attribute' => 'quantity',
         'pageSummary' => true,
         'readonly' => false,
         'format'=>['decimal',0],
               'value' => function($model){ return $model->quantity; }, // assign value from getProfileCompany method
               'editableOptions' => [
                'header' => 'Số lượng',
                'inputType' => Editable::INPUT_TEXT ,
                'options' => [
                    'pluginOptions' => [
                    //     'prefix' => '',
                    //    'suffix' => '',
                    //    'affixesStay' => false,
                       'thousands' => ',',
                       'decimal' => '.',
                    //    'precision' => 0, 
                    //    'allowZero' => true,
                    //    'allowNegative' => false,
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
                'header' => 'Giá',
                'asPopover' => false,
                'inputType' => Editable::INPUT_MONEY,
                'options' => [
                    'pluginOptions' => [
                        'prefix' => '$ ',
                        // 'suffix' => ' VNĐ',
                        'thousands' => '.',
                        'decimal' => ',',
                        'precision' => 0
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
                'header' => 'Kích hoạt',
                'inputType' => Editable::INPUT_DROPDOWN_LIST  ,
                'displayValueConfig'=> [
                    '0' => '<i class="fa fa-thumbs-down"></i> Hidden',
                    '1' => '<i class="fa fa-thumbs-up"></i> Active',
                ],
                'data' => [0 => 'Hidden', 1 => 'Active'],
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
            ],
        ],
        [
            'attribute' => 'updated_at',
            'format' => ['date', 'php:H:i  ->   d-m-Y']
        ],
        [
            'attribute'=>'user_add',
            'value'=>'user.username',
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'visibleButtons' => [
                'view' => Yii::$app->user->can('sanpham/product/view'),
                'update' => Yii::$app->user->can('sanpham/product/update'),
                'delete' => Yii::$app->user->can('sanpham/product/delete')
            ],
            'options'=>['style'=>'width:80px'],
            'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
            'dropdownOptions' => ['class' => 'float-right']
        ],
        [
            'class' => 'kartik\grid\CheckboxColumn',
            // 'options' => ['id' => 'hotel-pjax'],
            // 'containerOptions' => ['class' => 'hotel-pjax-container'],
        ]
    ];
    
    $scrollingTop = ['scrollingTop'=>'150'];
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        "id" => "grid",
        'bootstrap'=>true,
        'columns' => $gridColumns,
        // 'options' => ['id' => 'hotel-pjax'],
    'containerOptions' => ['style'=>'overflow: auto','class' => 'hotel-pjax-container'], // only set when $responsive = false
    // 'beforeHeader'=>[
    //     [
    //         // 'columns'=>[
    //         //     ['content'=>'Header Before 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
    //         //     ['content'=>'Header Before 2', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
    //         //     ['content'=>'Header Before 3', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
    //         // ],
    //         'options'=>['class'=>'skip-export'] // remove this row from export
    //     ]
    // ],
    'toolbar' =>  [
        ['content'=>
        Html::button('<i class="fa fa-trash-o"></i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Delete All'), 'class'=>'btn btn-success','id'=>'DeleteAll','onclick'=>'alert("Hành động này sẽ xóa tất cả dữ liệu được chọn.\n\nBạn có chắc chắn xóa !");']) . ' '.
        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/sanpham/product'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
    ],
    '{export}',
    '{toggleData}'
    ],
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => false,
    'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
    'showPageSummary' => false,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY
    ],
    ]);


?>
<?php Pjax::end(); ?>
</div>
<?php
$this->registerJsFile("@web/js/ajaxchange.js",['depends' => [\yii\web\JqueryAsset::className()]]); 
?>