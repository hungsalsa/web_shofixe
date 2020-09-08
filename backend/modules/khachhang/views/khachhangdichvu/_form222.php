<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kidzen\dynamicform\DynamicFormWidget;
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
?>
<div class="kh-dichvu-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form','enableClientValidation' => true, 'enableAjaxValidation' => true]); ?>
<section class="">
   <div class="sttabs tabs-style-iconfall">
      <nav>
         <ul>
            <li><a href="#section-iconfall-1" class="sticon ti-home"><span>Thông tin chung</span></a></li>
            <li><a href="#section-iconfall-2" class="sticon ti-gift"><span>Thông tin dịch vụ</span></a></li>
         </ul>
      </nav>
      <div class="content-wrap text-center">
         <section id="section-iconfall-1" style="min-height: 700px">
            <?= $form->field($model, 'day',['options' => ['class' => 'col-md-2']])->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Ngày sửa','autofocus' => 'autofocus'],
                'pluginOptions' => [
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
                        <?= $form->field($model, 'bandau',['options'=>['class'=>'col-md-6']])->textarea(['rows' => 6,'class'=>'content']) ?>
                        <?= $form->field($model, 'tontai',['options'=>['class'=>'col-md-6']])->textarea(['rows' => 6,'class'=>'content']) ?>
                        <?= $form->field($model, 'note',['options'=>['class'=>'col-md-6']])->textarea(['rows' => 4,'class'=>'content']) ?>
                        <?php if ($disable == true): ?>
                            <?= $form->field($model, 'cuahang_id')->hiddenInput()->label(false); ?>
                            <?= $form->field($model, 'id_kh')->hiddenInput()->label(false); ?>
                        <?php endif ?>
         </section>
         <section id="section-iconfall-2">
            
            
            <div class="row forminput">
               
                <div class="panel panel-default">
                <div class="panel-heading p-0 text-center">
                    <h4 class="col-md-4" style="height: 38px; margin: 0;line-height: 38px;font-size: 25px;"><i class="glyphicon glyphicon-envelope"></i> Các dịch vụ</h4>
                    
                    <div class="pull-right col-md-4">
                        <label class="control-label">Tổng tiền</label>
                        <label style="width: 100%;padding: 10px 2px;font-size: 20px" class="label label-success"><i class="glyphicon glyphicon-hand-right"></i>  <?= Yii::$app->formatter->asDecimal($model->total_money,0) ?></label>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body p-0" style="padding: 0 !important;">
                     <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 50, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $modelsKhChitietDv[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'id_Pro_dv',
                            'quantity',
                            'price',
                            'suffixes',
                        ],
                    ]); ?>

                    <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsKhChitietDv as $i => $modelKhChitietDv): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading p-0">
                                <h3 class="panel-title pull-left">Dịch vụ</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (! $modelKhChitietDv->isNewRecord) {
                                        echo Html::activeHiddenInput($modelKhChitietDv, "[{$i}]id");
                                    }
                                ?>
                                <div class="row">
                                    <div class="col-sm-8 text-left">
                                        <?= $form->field($modelKhChitietDv, "[{$i}]id_Pro_dv")->widget(Select2::classname(), [
                                            'data' => $dataDichvu,
                                            'language' => 'en',
                                            'options' => [
                                                'placeholder' => 'Chọn dịch vụ',
                                                'class'=>'text-left',
                                                'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl('/khachhang/khachhangdichvu/laygia?id=').'"+$(this).val(),
                                                    function(data){
                                                        alert($(this).val());
                                                        // $("select#cat-id{$i}").html(data);
                                                    })'

                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true,

                                            ],
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php if ($control == 'update'): ?>
                                            
                                        <?php else: ?>
                                            <?= $form->field($modelKhChitietDv, "[{$i}]price")->widget(Select2::classname(), [
                                            // 'data' => $dataDichvu,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Chọn dịch vụ','class'=>'text-left','id'=>'cat-id'."{$i}"],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                        ?>
                                        
                                        <?php endif ?>
                                        
                                        
                                    </div>
                                    <div class="col-sm-2">
                                        <?= $form->field($modelKhChitietDv, "[{$i}]suffixes")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?= $form->field($modelKhChitietDv, "[{$i}]quantity")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
            </div>

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
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>

