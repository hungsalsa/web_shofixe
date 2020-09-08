<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use kartik\select2\Select2;

$control = Yii::$app->controller->action->id;
 if($control == 'update' ){
    $disable = true;
 }else {
     $disable = false;
 }
?>

<div class="chingay-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form','enableClientValidation' => false,'enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'day',['options' => ['class' => 'col-md-2']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Ngày chi','disabled' => $disable],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true,
            'startDate'=> date('d-m-Y', strtotime(date("d-m-Y 0:0:0"))-16*60*60),
            'endDate'=> date('d-m-Y', strtotime(date("d-m-Y 0:0:0"))+16*60*60),
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

    <?= $form->field($model, 'nguoi_chi',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'options' => ['placeholder' => 'Kế toán xuất tiền','disabled' => $disable],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'nguoimua',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'options' => ['placeholder' => 'Kế toán xuất tiền','disabled' => $disable],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    
    <?= $form->field($model, 'status',['options'=>['class'=>'col-md-1']])->widget(Select2::classname(), [
        'data' => [0 =>'Lưu tạm',1=>'Xuất luôn'],
        'options' => ['placeholder' => 'Cửa hàng làm'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    
    <?= $form->field($model, 'kieunhap',['options'=>['class'=>'col-md-1']])->widget(Select2::classname(), [
        'data' => [0 =>'Nhập lẻ',1=>'Nhập toa'],
        'options' => ['placeholder' => 'Cửa hàng làm'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <div class="col-md-2 text-center">
        <label class="control-label">Tổng tiền</label><div class="clearfix"></div>
        <label style="width: 100%;padding: 8px 5px;font-size: 20px" class="label label-success"><i class="glyphicon glyphicon-hand-right"></i>  <?= Yii::$app->formatter->asDecimal($model->total_money,0) ?></label>
    </div>

    
    <!-- <div class="clearfix"></div> -->
    <div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 2]) ?>
   
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading text-center" style="padding:1px"><h4><i class="glyphicon glyphicon-envelope"></i> Các khoản chi</h4></div>
            <div class="panel-body" style="padding:0px">
               <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 50, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsChitietchi[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'name',
                    'quantity',
                    'money',
                    'ncc_id',
                    // 'motorbike',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsChitietchi as $i => $modelChitietchi): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <!-- <div class="panel-heading" style="padding:2px">
                            <h5 class="panel-title text-center col-md-10">Chi tiết</h5>
                            <div class="col-md-2">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div> -->
                        <div class="panel-body" style="padding:0 2px">
                            <?php
                            // necessary for update action.
                            if (! $modelChitietchi->isNewRecord) {
                                echo Html::activeHiddenInput($modelChitietchi, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($modelChitietchi, "[{$i}]name")->widget(Select2::classname(), [
                                        'data' => $dataKhoanchi,
                                        'options' => ['placeholder' => 'Tên xe chi'],
                                        'language' => 'en',
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]) ?>
                                </div>
                                <div class="col-sm-1">
                                    <?= $form->field($modelChitietchi, "[{$i}]quantity")->textInput(['maxlength' => true,'type'=>'number']) ?>
                                </div>
                                <div class="col-sm-1">
                                    <?= $form->field($modelChitietchi, "[{$i}]money")->textInput(['maxlength' => true,'placeholder' => '/1 ĐVT','type'=>'number']) ?>
                                </div>
                                
                                <div class="col-sm-2">
                                    <?= $form->field($modelChitietchi, "[{$i}]ncc_id")->widget(Select2::classname(), [
                                        'data' => $dataSupplier,
                                        'options' => ['placeholder' => 'Nhập của'],
                                        'language' => 'en',
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ])->label('<span>Nguồn nhập</span>'.Html::a('<i class="fa fa-plus-circle"></i>', ['/quantri/supplier/create'], ['title' => 'Thêm nguồn nhập', 'style' => 'margin-left:10px','target' => '_blank','data' => ['pjax' => 0]])) ?>
                                </div>
                                <div class="col-md-1 pull-right" style="padding: 30px;">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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

    <div class="form-group btn_save">
        <?= Html::submitButton($modelChitietchi->isNewRecord ? 'Thêm mới' : 'Chỉnh sửa', ['class' => 'btn btn-primary btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
// $this->registerJsFile("@web/js/jquery.min.js");