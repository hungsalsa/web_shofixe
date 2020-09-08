<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use common\helpers\CustomGridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
use yii\helpers\Url;
// use kartik\mpdf\Pdf;

$this->title = 'Danh sách dịch vụ';
$this->params['breadcrumbs'][] = $this->title;
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
    // 'madichvu',
    [
     'class' => 'kartik\grid\EditableColumn',
     'attribute' => 'madichvu',
     // 'pageSummary' => true,
     'readonly' => false,
       'value' => function($model){ return $model->madichvu; }, // assign value from getProfileCompany method
        'editableOptions' => [
            'header' => 'Tên dịch vụ',
            'size'=>'md',
            'inputType' => kartik\editable\Editable::INPUT_TEXT,
                'options' => [
                'pluginOptions' => [
                   'name'=>'madichvu',
                ]
            ]
        ],
    ],
    [
     'class' => 'kartik\grid\EditableColumn',
     'attribute' => 'tendv',
     // 'pageSummary' => true,
     'readonly' => false,
                   'value' => function($model){ return $model->tendv; }, // assign value from getProfileCompany method
                   'editableOptions' => [
                    'header' => 'Tên dịch vụ',
                    'size'=>'md',
                    'inputType' => kartik\editable\Editable::INPUT_TEXT,
                    'options' => [
                        'pluginOptions' => [
                         'name'=>'KhachhangDichvuList[tendv]',
                     ]
                 ]
             ],
         ],
        [
         'class' => 'kartik\grid\EditableColumn',
         'attribute' => 'price',
         // 'pageSummary' => true,
         'readonly' => false,
         'format'=>['decimal',0],
               'value' => function($model){ return $model->price; }, // assign value from getProfileCompany method
               'editableOptions' => [
                'header' => 'price',
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
         // 'pageSummary' => true,
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
        'phutung',
        [
            'attribute'=>'xe_sd',
            'value'=>'xeKhach.bikeName'
        ],
        [
            'attribute' => 'updated_at',
            'format' => ['date', 'php:H:i  ->   d-m-Y']
        ],
        [
            'attribute'=>'user_add',
            'value'=>'user.fullname',
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'options'=>['style'=>'width:80px'],
            'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
            'dropdownOptions' => ['class' => 'float-right'],
            'visibleButtons' => [
                'view' => Yii::$app->user->can('khachhang/danhsachdichvu/view'),
                'update' => Yii::$app->user->can('khachhang/danhsachdichvu/update'),
                'delete' => Yii::$app->user->can('khachhang/danhsachdichvu/delete')
            ],
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
    $exportFilename = 'Khachhang_danhsach_dichvu_' . date("Y-m-d_H-m-s");
    $scrollingTop = ['scrollingTop'=>'150'];
    if (getUser()->manager == 1 ) {
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
        $export = [
                'fontAwesome' => TRUE
            ];
    }else {
        $export = $exportConfig = false;
    }

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        "id" => "grid",
        'bootstrap'=>true,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} dịch vụ",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
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
    'export' => $export,
    'exportConfig' => $exportConfig,
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



