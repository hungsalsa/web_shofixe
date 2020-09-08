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

    <?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => false]); ?>
<section class="">
   <div class="sttabs tabs-style-bar">
      <nav>
         <ul>
            <li><a href="#section-iconfall-1" class="sticon ti-home"><span>Thông tin dịch vụ</span></a></li>
            <li><a href="#section-iconfall-2" class="sticon ti-gift"><span>Tình trạng xe</span></a></li>
         </ul>
      </nav>
      <div class="content-wrap text-center">
         <section id="section-iconfall-1" style="min-height: 700px">
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
            <?= $form->field($model, 'id_kh',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), 
                [
                    'data' => $dataKhachhang,
                    'options' => ['placeholder' => 'Chọn khách hàng'/*,'disabled' => true*/],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) 
                ?>

            <?= $form->field($model, 'id_xe',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
                [
                    'data' => $dataXeKH,
                    'options' => ['placeholder' => 'Chọn xe của khách'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) 
                ?>
           

            <?= $form->field($model, 'id_ketoan',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
                [
                    'data' => $dataEmployee,
                    'options' => ['placeholder' => 'Kế toán'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) 
                ?>
                <div class="clearfix"></div>

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
            <?= $form->field($model, 'time_from',['options'=>['class'=>'col-md-1']])->widget(TimePicker::classname(), [
                'size' => 'md',
                'pluginOptions' => [
                    'template' => false,
                    'showMeridian' => false,
                    'defaultTime' =>date('H:i:s'),
                ]
            ]); ?>

            <?= $form->field($model, 'time_to',['options'=>['class'=>'col-md-1']])->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'template' => false,
                    'showMeridian' => false,
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
                    <div class="clearfix"></div>
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
                                        'data' => [],
                                        'options' => ['placeholder' => 'Chon một','id'=>'subcat-id'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'depends'=>['cat-id'],
                                            'placeholder'=>'Select...',
                                            'url'=>Url::to(['/khachhang/khachhangdichvu/laygia'])
                                        ],
                                    ]);?>
                                <?= $form->field($adddv, "suffixes",['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'id'=>'dv_suffixes']) ?>
                                <?= $form->field($adddv, "quantity",['options'=>['class'=>'col-md-1']])->textInput(['type' => 'number','min' => 1,'id'=>'dv_quantity']) ?>
                                <div class="col-md-2" style="margin-top: 25px">
                                <?= Html::button('Thêm dịch vụ', ['class' => 'btn btn-info btn-md btn-block btn_luu add']) ?>
                                </div>  
                        </div> 
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="4%">STT</th>
                                        <th>Dịch vụ</th>
                                        <th width="10%">Hậu tố</th>
                                        <th width="12%">Giá</th>
                                        <th width="8%">Số lượng</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="danhsachdichvu">
                                    
                                </tbody>
                            </table>
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
         <!-- <section id="section-iconfall-3">
            <h2>Tabbing 3</h2>
         </section>
         <section id="section-iconfall-4">
            <h2>Tabbing 4</h2>
         </section>
         <section id="section-iconfall-5">
            <h2>Tabbing 5</h2>
         </section> -->
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
<?php $this->registerCss("
    div.mce-fullscreen {
        z-index: 1001;
    }
    @media print {
        .navbar-default.sidebar,.navbar.navbar-default.navbar-static-top,.right-side-toggle,.formsearch,.thongke,footer{
            display: none;
        }
    }

");
?>

<?php
$this->registerJsFile('@web/js/dichvu/addchitiet.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>
