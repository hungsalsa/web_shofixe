<?php
use yii\helpers\Html;
use kartik\grid\GridView;
// use kartik\color\ColorInput;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use backend\modules\quantri\models\CuaHang;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sanpham\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách nhân viên';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->getModule('gridview');
$location = [
    1 =>'Quản lý',
    2 =>'Cửa hàng trưởng',
    3 =>'Kế toán',
    4 =>'Nhân viên'
];
            
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
    // 'id',
    [
     'class' => 'kartik\grid\EditableColumn',
     'attribute' => 'name',
     // 'pageSummary' => true,
     'readonly' => false,
       'value' => function($model){ return $model->name; }, // assign value from getProfileCompany method
        'editableOptions' => [
            'header' => 'Tên nhân viên',
            'size'=>'md',
            'inputType' => Editable::INPUT_TEXT,
                'options' => [
                'pluginOptions' => [
                   'name'=>'Employee[name]',
                ]
            ]
        ],
    ],
      
    [
        'attribute' => 'cua_hang',
        'value' => function($data){
            $cuahang = new CuaHang();
            return $cuahang->getNameByArray(json_decode($data->cua_hang));
        },
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
        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/quantri/employee'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
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
    'floatHeader' => true,
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
    // $this->registerJsFile("@web/js/ajaxchange.js",['depends' => [\yii\web\JqueryAsset::className()]]); 
?>