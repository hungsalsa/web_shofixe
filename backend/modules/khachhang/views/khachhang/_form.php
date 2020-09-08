<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhachHang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="khach-hang-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'phone',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    <div class="clearfix"></div>
    
    <?= $form->field($model, 'email',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, "status",['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => [0=>'Lưu tạm',1=>'Kích hoạt'],
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn nghề nghiệp'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'birthday',['options' => ['class' => 'col-md-2']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Ngày sinh'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 6,'class'=>'content']) ?>

    <div class="clearfix"></div>
    <div class="row forminput">
        <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Xe khách hàng</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 50, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsKHXe[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'xe',
                    'bks',
                    'quanhe',
                    'color',
                    'nguoi_sd',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsKHXe as $i => $modelxe): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Các xe của khách hàng</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelxe->isNewRecord) {
                                echo Html::activeHiddenInput($modelxe, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= '<label>Xe khách hàng'.Html::a('<i class="fa fa-plus-circle"></i>', ['/quantri/motorbike/create'], ['title' => 'Thêm 1 xe mới', 'style' => 'margin-left:10px','target' => '_blank','data' => ['pjax' => 0]]).'</label>' ?>
                                <?= 
                                Select2::widget([
                                    'model' => $modelxe,
                                    'attribute' => "[{$i}]xe",
                                    'data' => $dataMotor,
                                    'options' => ['placeholder' => 'Select a state ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                 ?>
                                <!-- $form->field($modelxe, "[{$i}]xe")->widget(Select2::classname(), [
                                            'data' => $dataMotor,
                                            'language' => 'en',
                                            'options' => ['placeholder' => 'Chọn xe'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ])
                                ->textInput(['maxlength' => true]);
                                 -->
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelxe, "[{$i}]bks") ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelxe, "[{$i}]color")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelxe, "[{$i}]nguoi_sd")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelxe, "[{$i}]quanhe")->textInput(['maxlength' => true]) ?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>