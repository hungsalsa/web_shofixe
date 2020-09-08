<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\CuaHang;
use kartik\editable\Editable;
use common\helpers\CustomGridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Danh sách User bạn quản lý';
$this->params['breadcrumbs'][] = $this->title;

$cuahang = new CuaHang();
$datacuahang = $cuahang->getAllCuahang();
// if($data->cuahang_id != '')
// {
//     $datacuahang =  $cuahang->getNameByArray(json_decode($data->cuahang_id));
// }
// $cuaa = $cuahang->getAllCuahangUser([1,2,3]);
// dbg($cuaa);

?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right btn_save">
        <?= Html::a('Thêm mới', ['signup'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        'id',
    // 'madichvu',
        [
           'class' => 'kartik\grid\EditableColumn',
           'attribute' => 'username',
           // 'pageSummary' => true,
           'readonly' => false,
       'value' => function($model){ return $model->username; }, // assign value from getProfileCompany method
       'editableOptions' => [
        'header' => 'Tên dịch vụ',
        'size'=>'md',
        'inputType' => kartik\editable\Editable::INPUT_TEXT,
        'options' => [
            'pluginOptions' => [
             'name'=>'username',
         ]
     ]
 ],
],
[
   'class' => 'kartik\grid\EditableColumn',
   'attribute' => 'fullname',
   // 'pageSummary' => true,
   'readonly' => false,
                   'value' => function($model){ return $model->fullname; }, // assign value from getProfileCompany method
                   'editableOptions' => [
                    'header' => 'Tên đầy đủ',
                    'size'=>'md',
                    'inputType' => kartik\editable\Editable::INPUT_TEXT,
                    'options' => [
                        'pluginOptions' => [
                           'name'=>'User[fullname]',
                       ]
                   ]
               ],
           ],
           [
            'attribute' => 'image',
            'format' => 'html',    
            'value' => function ($data) {
                return Html::img($data['image'],
                    ['width' => '70px']);
            },
        ],
        [
           'class' => 'kartik\grid\EditableColumn',
           'attribute' => 'manager',
           // 'pageSummary' => true,
           'readonly' => false,
           'format'=>['decimal',0],
               'value' => function($model){ return $model->manager; }, // assign value from getProfileCompany method
               'editableOptions' => [
                'header' => 'Quản lý',
                'inputType' => Editable::INPUT_DROPDOWN_LIST  ,
                'displayValueConfig'=> [
                    '0' => '<i class="fa fa-thumbs-down"></i> Hidden',
                    '1' => '<i class="fa fa-thumbs-up"></i> Active',
                ],
                'data' => [0 => 'Hidden',10 =>'Active'],
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
            ],
        ],
        [
           'class' => 'kartik\grid\EditableColumn',
           'attribute' => 'editquantity',
           // 'pageSummary' => true,
           'readonly' => false,
               'value' => function($model){ return $model->editquantity; }, // assign value from getProfileCompany method
               'editableOptions' => [
                'header' => 'Chỉnh giá',
                'inputType' => Editable::INPUT_DROPDOWN_LIST  ,
                'displayValueConfig'=> [
                    '0' => '<i class="fa fa-thumbs-down"></i> Hidden',
                    '1' => '<i class="fa fa-thumbs-up"></i> Active',
                ],
                'data' => [0 => 'Hidden',1 =>'Active'],
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                
                // 'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
            ],
        ],
        [
           'class' => 'kartik\grid\EditableColumn',
           'attribute' => 'cuahang_id',
           // 'pageSummary' => true,
           'readonly' => false,
           'value' => function($data){ //dbg(json_decode($data->cuahang_id));
            $cuahang = new CuaHang();
            // dbg($cuahang->getAllCuahangUser(json_decode($data->cuahang_id)));
            return $cuahang->getAllCuahangUser(json_decode($data->cuahang_id));
                }, // assign value from getProfileCompany method
            'editableOptions' => [
                'header' => 'Cua hang',
                'inputType' => Editable::INPUT_DROPDOWN_LIST  ,
                'displayValueConfig'=> $datacuahang,
                // [
                //     '0' => '<i class="fa fa-thumbs-down"></i> Hidden',
                //     '1' => '<i class="fa fa-thumbs-up"></i> Active',
                // ],
                'data' => $datacuahang,
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...','multiple'=>true],
            ],
            ],
            [
               'class' => 'kartik\grid\EditableColumn',
               'attribute' => 'view_cuahang',
               // 'pageSummary' => true,
               'readonly' => false,
                   'value' => function($model){ return $model->view_cuahang; }, // assign value from getProfileCompany method
                   'editableOptions' => [
                    'header' => 'Xem cửa hàng',
                    'inputType' => Editable::INPUT_DROPDOWN_LIST  ,
                    'displayValueConfig'=> [
                        '0' => '<i class="fa fa-thumbs-down"></i> Hidden',
                        '1' => '<i class="fa fa-thumbs-up"></i> Active',
                    ],
                    'data' => [0 => 'Hidden',1 =>'Active'],
                    'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                    
                    // 'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                ],
            ],
            [
               'class' => 'kartik\grid\EditableColumn',
               'attribute' => 'status',
               // 'pageSummary' => true,
               'readonly' => false,
                   'value' => function($model){ return $model->status; }, // assign value from getProfileCompany method
                   'editableOptions' => [
                    'header' => 'Kích hoạt',
                    'inputType' => Editable::INPUT_DROPDOWN_LIST  ,
                    'displayValueConfig'=> [
                        '0' => '<i class="fa fa-thumbs-down"></i> Hidden',
                        '10' => '<i class="fa fa-thumbs-up"></i> Active',
                    ],
                    'data' => [0 => 'Hidden',10 =>'Active'],
                    'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                    
                    // 'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                ],
            ],
            // [
            //     'attribute' => 'created_at',
            //     'format' => ['date', 'php:H:i d-m-Y']
            // ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute'=>'user_update',
                'value'=>'update.username',
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'options'=>['style'=>'width:8%'],
                'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
                'dropdownOptions' => ['class' => 'float-right'],
                'template' => '{view}  {update}  {delete}  {resetpassword}',
                'buttons'  => [
                    'resetpassword'   => function ($url, $model) {
                        $url = Url::to(['user/resetpassword', 'id' => $model->id]);
                        return Html::a('<span class="fa fa-key"></span>', $url, ['title' => 'Reset Password','style'=>'margin-left:3px;font-size:23px;font-weight:bold;']);
                    },
                ]
            ],
            [
                'class' => 'kartik\grid\CheckboxColumn',
            // 'options' => ['id' => 'hotel-pjax'],
            // 'containerOptions' => ['class' => 'hotel-pjax-container'],
            ]
        ];
        $ourPdfHeader = [
            'L' => [
                'content'   => 'Custom L',
                'font-size' => 8,
                'color'     => '#333333'
            ],
            'C' => [
                'content'   => 'Custom C',
                'font-size' => 16,
                'color'     => '#333333'
            ],
            'R' => [
                'content'   => 'Generated' . ': ' . date("D, d-M-Y g:i a T"),
                'font-size' => 8,
                'color'     => '#333333'
            ]
        ];
        $ourPdfFooter = [
            'L'    => [
                'content'    => 'Custom Footer',
                'font-size'  => 8,
                'font-style' => 'B',
                'color'      => '#999999'
            ],
            'R'    => [
                'content'     => '[ {PAGENO} ]',
                'font-size'   => 10,
                'font-style'  => 'B',
                'font-family' => 'serif',
                'color'       => '#333333'
            ],
            'line' => TRUE,
        ];
        $exportFilename = 'user_' . date("Y-m-d_H-m-s");
        $scrollingTop = ['scrollingTop'=>'150'];
        $exportConfig = [

            // CustomGridView::HTML  => [
            //     'label'           => 'HTML',
            //     'icon'            => 'file-text',
            //     'iconOptions'     => ['class' => 'text-info'],
            //     'showHeader'      => TRUE,
            //     'showPageSummary' => TRUE,
            //     'showFooter'      => TRUE,
            //     'showCaption'     => TRUE,
            //     'filename'        => $exportFilename,
            //     'alertMsg'        => 'Tệp HTML sẽ được tạo để tải xuống.',
            //     'options'         => ['title' => 'Hyper Text Markup Language'],
            //     'mime'            => 'text/html',
            //     'config'          => [
            //         'cssFile' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'
            //     ]
            // ],
            CustomGridView::CSV   => [
                'label'           => 'CSV',
                'icon'            => 'file-code-o',
                'iconOptions'     => ['class' => 'text-primary'],
                'showHeader'      => TRUE,
                'showPageSummary' => TRUE,
                'showFooter'      => TRUE,
                'showCaption'     => TRUE,
                'filename'        => $exportFilename,
                'alertMsg'        => 'The CSV export file will be generated for download.',
                'options'         => ['title' => 'Comma Separated Values'],
                'mime'            => 'application/csv',
                'config'          => [
                    'colDelimiter' => ",",
                    'rowDelimiter' => "\r\n",
                ]
            ],
            CustomGridView::EXCEL => [
                'label'           => 'Excel',
                'icon'            => 'file-excel-o',
                'iconOptions'     => ['class' => 'text-success'],
                'showHeader'      => TRUE,
                'showPageSummary' => TRUE,
                'showFooter'      => TRUE,
                'showCaption'     => TRUE,
                'filename'        => $exportFilename,
                'alertMsg'        => 'The EXCEL export file will be generated for download.',
                'options'         => ['title' => 'Microsoft Excel 95+'],
                'mime'            => 'application/vnd.ms-excel',
                'config'          => [
                    'worksheet' => 'Worksheet',
                    'cssFile'   => ''
                ]
            ],
            CustomGridView::PDF   => [
                'label'           => 'PDF',
                'icon'            => 'file-pdf-o',
                'iconOptions'     => ['class' => 'text-danger'],
                'showHeader'      => TRUE,
                'showPageSummary' => TRUE,
                'showFooter'      => TRUE,
                'showCaption'     => TRUE,
                'filename'        => $exportFilename,
                'alertMsg'        => 'The PDF export file will be generated for download.',
                'options'         => ['title' => 'Portable Document Format'],
                'mime'            => 'application/pdf',
                'config'          => [
                    'mode'          => 'c',
                    'format'        => 'A4-L',
                    'destination'   => 'D',
                    'marginTop'     => 20,
                    'marginBottom'  => 20,
                    'cssInline'     => '.kv-wrap{padding:20px;}' .
                    '.kv-align-center{text-align:center;}' .
                    '.kv-align-left{text-align:left;}' .
                    '.kv-align-right{text-align:right;}' .
                    '.kv-align-top{vertical-align:top!important;}' .
                    '.kv-align-bottom{vertical-align:bottom!important;}' .
                    '.kv-align-middle{vertical-align:middle!important;}' .
                    '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                    '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                    '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
                    'methods'       => [
                        'SetHeader' => [
                            ['odd' => $ourPdfHeader, 'even' => $ourPdfHeader]
                        ],
                        'SetFooter' => [
                            ['odd' => $ourPdfFooter, 'even' => $ourPdfFooter]
                        ],
                    ],
                    'options'       => [
                        'title'    => 'Custom Title',
                        'subject'  => 'PDF export',
                        'keywords' => 'pdf'
                    ],
                    'contentBefore' => '',
                    'contentAfter'  => ''
                ]
            ]
        ];

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
            [
                'content'=>
                Html::button('<i class="fa fa-trash-o"></i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Delete All'), 'class'=>'btn btn-success','id'=>'DeleteAll','onclick'=>'alert("Hành động này sẽ xóa tất cả dữ liệu được chọn.\n\nBạn có chắc chắn xóa !");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/khachhang/danhsachdichvu'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
            ],
            '{export}',
            '{toggleData}'
        ],
        'export'           => [
            'fontAwesome' => TRUE
        ],
        'exportConfig'     => $exportConfig,
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
        'showPageSummary' => false,
        'panel'            => [
            'type'    => CustomGridView::TYPE_INFO,
            'heading' => '<i class="fa fa-bar-chart-o"></i> Report',
        ],
    // 'panel' => [
    //     'type' => GridView::TYPE_PRIMARY
    // ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
<?php
// $this->registerJsFile(Yii::$app->request->baseUrl.'bootstrap/dist/js/bootstrap.min.js',['depends' => [\yii\web\JqueryAsset::className()]]); 
// $this->registerJsFile(Yii::$app->request->baseUrl.'/js/ajaxchange.js',['depends' => [\yii\web\JqueryAsset::className()]]); 
?>
