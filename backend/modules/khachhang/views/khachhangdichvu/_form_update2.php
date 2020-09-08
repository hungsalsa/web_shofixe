<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    // use kidzen\dynamicform\DynamicFormWidget;
    use kartik\date\DatePicker;
    use kartik\select2\Select2;
    use kartik\time\TimePicker;
    use kartik\number\NumberControl;
    use kartik\depdrop\DepDrop;
    use yii\helpers\Url;

    $control = Yii::$app->controller->action->id;
    $cache = Yii::$app->cache;
    $dataDichvu = $cache->get('cache_app_dichvukh');
    if($control == 'update' ){
        $disable = true;
    }else {
       $disable = false;
    }
    // $dataprice =[];
?>
<div class="kh-dichvu-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => true]); ?>
<section class="">
   <div class="sttabs tabs-style-iconfall">
      <nav>
         <ul>
            <li><a href="#thongtinchung" class="sticon ti-home"><span>Thông tin chung</span></a></li>
            <li><a href="#section-iconfall-2" class="sticon ti-gift"><span>Thông tin dịch vụ</span></a></li>
         </ul>
      </nav>
      <div class="content-wrap text-center">
         <section id="thongtinchung" style="min-height: 700px">
            <?= $form->field($model, 'day',['options' => ['class' => 'col-md-2']])->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Ngày sửa'],
                'pluginOptions' => [
                    // ,'autofocus' => 'autofocus'
                    'autoclose'=>true,
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true
                ]
            ]);?>
            <?= $form->field($model, 'cuahang_id',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
                'data' => $dataCuahang,
                'options' => ['placeholder' => 'Cửa hàng làm','disabled' => $disable],
                'language' => 'en',
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
            <?= $form->field($model, 'id_kh',['options'=>['class'=>'col-md-5']])->widget(Select2::classname(), 
                [
                    'data' => $dataKhachhang,
                    'options' => ['placeholder' => 'Chọn khách hàng','disabled' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) 
                ?>
            <?= $form->field($model, 'id_xe',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), 
                [
                    'data' => $dataXeKH,
                    'options' => ['placeholder' => 'Chọn xe của khách'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) 
                ?>
            <div class="clearfix"></div>

            <?= $form->field($model, 'id_ketoan',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
                [
                    'data' => $dataEmployee,
                    'options' => ['placeholder' => 'Kế toán'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) 
                ?>

            <?= $form->field($model, 'id_nhanvien',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
                [
                    'data' => $dataEmployee,
                    'options' => ['placeholder' => 'Nhân viên làm','multiple'=>true],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) 
                ?>

                

            <?= $form->field($model, 'id_quanly',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
            [
                'data' => $dataEmployee,
                'options' => ['placeholder' => 'Quản lý'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) 
            ?>
            <?= $form->field($model, 'time_from',['options'=>['class'=>'col-md-2']])->widget(TimePicker::classname(), [
                'size' => 'md',
                'pluginOptions' => [
                    'template' => false,
                    'defaultTime' =>date('H:i:s'),
                ]
            ]); ?>

            <?= $form->field($model, 'time_to',['options'=>['class'=>'col-md-2']])->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'template' => false,
                    'defaultTime' =>false,
                ]
            ]); ?>

                <?= $form->field($model, 'sophieu',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
                    [
                        'data' => $datasophieu,
                        'options' => ['placeholder' => '-- select --'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) 
                    ?>
                    <div class="clearfix"></div>
                    <?= $form->field($model, 'tienthu_kh',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
                        'maskedInputOptions' => [
                            'suffix' => '',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'displayOptions' => ['class' => 'form-control kv-monospace','placeholder' => 'ko nhập sẽ bằng tổng tiền'],
                        'saveInputContainer' => ['class' => 'kv-saved-cont']
                    ]);
                    ?>
                    <?= $form->field($model, 'thanhtoan',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
                    [
                        'data' => [0 =>'Tiền mặt',1=>'Thanh toán thẻ',2=>'Chuyển khoản'],
                        'options' => ['placeholder' => 'ko chọn sẽ là tiền mặt'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) 
                    ?>

                    <?= $form->field($model, 'status',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
                        [
                            'data' => [0 =>'Lưu tạm',1=>'Xuất luôn',2=>'Chưa thanh toán'],
                            'options' => ['placeholder' => 'Chon một'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]) 
                        ?>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="row">
                                <?= $form->field($adddv, 'dichvu',['options'=>['class'=>'col-md-5']])->widget(Select2::classname(), 
                                    [
                                        'data' => $dataDichvu,
                                        'options' => ['placeholder' => 'Chon một','id'=>'cat-id'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ],
                                    ]);?>
                                    
                                <?= $form->field($adddv, 'price',['options'=>['class'=>'col-md-2']])->widget(DepDrop::classname(), 
                                    [
                                        // 'data' => $dataDichvu,
                                        'options' => ['placeholder' => 'Chon một','id'=>'subcat-id'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'depends'=>['cat-id'],
                                            'placeholder'=>'Select...',
                                            'url'=>Url::to(['/khachhang/khachhangdichvu/laygia'])
                                        ],
                                    ]);?>
                                <?= $form->field($adddv, "suffixes",['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'id'=>'dv_suffixes']) ?>
                                <?= $form->field($adddv, "quantity",['options'=>['class'=>'col-md-1']])->textInput(['type' => 'number','id'=>'dv_quantity']) ?>
                                <div class="col-md-2">
                                <?= Html::button('Thêm dịch vụ', ['class' => 'btn btn-info btn-md btn-block btn_luu add']) ?>
                                </div>  
                        </div> 
                        <div class="row">

                            <div class="panel">
                                <div class="panel-heading">Danh sách dịch vụ</div>
                                <div class="table-responsive">
                                    <table class="table table-hover color-table success-table">
                                        <thead>
                                            <tr class="text-right">
                                                <th width="3%" class="text-center">STT</th>
                                                <th class="text-center" width="30%">Tên dịch vụ</th>
                                                <th width="8%"  class="text-center">Hậu tố</th>
                                                <th width="8%"  class="text-center">Giá dịch vụ</th>
                                                <th width="5%"  class="text-center">Số lượng</th>
                                                <th width="7%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="danhsachdichvu">
                                            <?php   foreach ($modelsKhChitietDv as $key => $chitiet): ?>
                                                <tr class="dichvu_<?= $chitiet->id ?>">
                                                    <td><?= $key+1 ?></td>
                                                    <td><?= isset($chitiet->danhsachdv->tendv) ? $chitiet->danhsachdv->tendv :''?></td>
                                                    <td><?= $chitiet->suffixes ?></td>
                                                    <td><?= Yii::$app->formatter->asDecimal($chitiet->price,0) ?></td>
                                                    <td><?= $chitiet->quantity ?></td>

                                                    <td>
                                                        <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5 changeChitietdv"  data-id="<?= $chitiet->id ?>"><i class="ti-pencil-alt"></i></button>
                                                        <?php if ($key != 0): ?>
                                                        <button type="button" class="btn btn-danger btn-outline btn-circle btn-lg m-r-5 deleteChitiet" data-url="<?= Yii::$app->getUrlManager()->createUrl(['/khachhang/khachhangdichvu/xoachitiet','id'=>$chitiet->id]) ?>" data-id="<?= $chitiet->id ?>"><i class="ti-trash"></i></button>

                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                                <tr class="Update_dichvu_<?= $chitiet->id ?> updateDichvu" style="display: none" data-url="<?= Yii::$app->getUrlManager()->createUrl(['/khachhang/khachhangdichvu/suachitiet','id'=>$chitiet->id]) ?>">
                                                    <td class="stt_<= $chitiet->id ?>"><?= $key+1 ?></td>
                                                    <td>
                                                        <?= $form->field($chitiet, 'id_Pro_dv')->widget(Select2::classname(), 
                                                            [
                                                                'data' => $dataDichvu,
                                                                'options' => ['placeholder' => 'Chon một','id'=>'cat-id'.$chitiet->id,'allowClear' => true],
                                                                'pluginOptions' => [
                                                                    'allowClear' => true,
                                                                ],
                                                            ])->label(false);?>


                                                            <?php // Html::hiddenInput($chitiet->id, $chitiet->id, ['id'=>$chitiet->price]); ?>
                                                        </td>
                                                        <td>
                                                            <?= $form->field($chitiet, "suffixes")->textInput(['maxlength' => true,'id'=>'dv_suffixes'.$chitiet->id])->label(false) ?>
                                                        </td>
                                                        <td>
                                                            <?= $form->field($chitiet, 'price')->widget(DepDrop::classname(), 
                                                                [
                                                                    'options' => ['placeholder' => 'Chon một','id'=>'subcat-id'.$chitiet->id],
                                                                    'pluginOptions' => [
                                                                        'allowClear' => true,
                                                                        'depends'=>['cat-id'.$chitiet->id],
                                                                        'type' => DepDrop::TYPE_SELECT2,
                                                                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                                                        'url'=>Url::to(['/khachhang/khachhangdichvu/laygia']),
                                                                            // 'loadingText' => 'Loading child level 1 ...',
                                                                            // 'params'=>[$chitiet->id]
                                                                    ],
                                                                ])->label(false);?>
                                                            </td>
                                                            <td>
                                                                <?= $form->field($chitiet, "quantity")->textInput(['type' => 'number','id'=>'dv_quantity'.$chitiet->id])->label(false) ?>
                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5 saveChitietdv" data-id="<?= $chitiet->id ?>"><i class="ti-save-alt"></i></button>
                                                                <button type="button" class="cancelChange btn btn-danger btn-outline btn-circle btn-lg m-r-5" data-id="<?= $chitiet->id ?>"><i class="ti-close"></i></button>
                                                            </td>
                                                        </tr>


                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                           
                        </div>                    
                        
         </section>
         <section id="section-iconfall-2">
            <?= $form->field($model, 'bandau',['options'=>['class'=>'col-md-6']])->textarea(['rows' => 6,'class'=>'content']) ?>
                        <?= $form->field($model, 'tontai',['options'=>['class'=>'col-md-6']])->textarea(['rows' => 6,'class'=>'content']) ?>
                        <?= $form->field($model, 'note',['options'=>['class'=>'col-md-6']])->textarea(['rows' => 4,'class'=>'content']) ?>
                        <?php if ($disable == true): ?>
                            <?= $form->field($model, 'cuahang_id')->hiddenInput()->label(false); ?>
                            <?= $form->field($model, 'id_kh')->hiddenInput()->label(false); ?>
                        <?php endif ?>
            
            
            

         </section>
        
      </div>
      <!-- /content -->
   </div>
   <!-- /tabs -->
</section>

<div class="form-group btn_save">
    <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    <?= Html::a('Reset dịch vụ','/backend/khachhang/danhsachdichvu/resetdichvu',['class'=>'btn btn-danger p-4']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>
<?php 
// $this->registerCss("
//     div.mce-fullscreen {
//         z-index: 1001;
//     }
//     @media print {
//         .navbar-default.sidebar,.navbar.navbar-default.navbar-static-top,.right-side-toggle,.formsearch,.thongke,footer{
//             display: none;
//         }
//     }

// ");
?>

<?php

$this->registerJsFile('@web/js/addchitiet.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>
