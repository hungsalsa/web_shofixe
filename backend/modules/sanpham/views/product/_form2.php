<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use kartik\number\NumberControl;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => false]); ?>
    

    <?= $form->field($model, 'idPro',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
        [
            'options' => ['placeholder' => 'Input product code'],
            'pluginOptions' => [
                'tags' =>true,
                'allowClear' => true,
            ],
        ]) 
    ?>

    <?= $form->field($model, 'proName',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, "cate_id",['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataCate,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('<span>Danh mục sản phẩm</span>'.Html::a('<i class="fa fa-plus-circle"></i>', ['/sanpham/productcate/create'], ['title' => 'Thêm đơn vị tính', 'style' => 'margin-left:10px','target' => '_blank','data' => ['pjax' => 0]]));
    ?>

    
    <?= $form->field($model, 'cuahang_id',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'options' => ['placeholder' => '-- chọn cửa hàng --'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true,
        ],

    ])
    ?>
    <?= $form->field($model, 'status',['options' => ['class' => 'btn_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    
    <?= $form->field($model, 'quantity',['options' => ['class' => 'col-md-1']])->textInput(['type'=>'number','min' => 0]) ?>

    <?= $form->field($model, 'import_price',['options'=>['class'=>'col-md-1']])->widget(NumberControl::classname(), [
        'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
            'suffix' => '',
            'allowMinus' => false,
            'groupSeparator' => '.',
            'radixPoint' => ','
        ],
        'displayOptions' => ['class' => 'form-control kv-monospace'],
        'saveInputContainer' => ['class' => 'kv-saved-cont']
    ]);
    ?>
    <?= $form->field($model, 'price',['options'=>['class'=>'col-md-1']])->widget(NumberControl::classname(), [
        'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
            'suffix' => '',
            'allowMinus' => false,
            'groupSeparator' => '.',
            'radixPoint' => ','
        ],
        'displayOptions' => ['class' => 'form-control kv-monospace'],
        'saveInputContainer' => ['class' => 'kv-saved-cont']
    ]);
    ?>
    <?= $form->field($model, 'price_sale',['options'=>['class'=>'col-md-1']])->widget(NumberControl::classname(), [
        'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
            'suffix' => '',
            'allowMinus' => false,
            'groupSeparator' => '.',
            'radixPoint' => ','
        ],
        'displayOptions' => ['class' => 'form-control kv-monospace'],
        'saveInputContainer' => ['class' => 'kv-saved-cont']
    ]);
    ?>
    <?= $form->field($model, 'cong_dv',['options'=>['class'=>'col-md-1']])->widget(NumberControl::classname(), [
        'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
            'suffix' => '',
            'allowMinus' => false,
            'groupSeparator' => '.',
            'radixPoint' => ','
        ],
        'displayOptions' => ['class' => 'form-control kv-monospace'],
        'saveInputContainer' => ['class' => 'kv-saved-cont']
    ]);
    ?>
    
    
    <?= $form->field($model, 'unit',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
        [
            'data' => $dataUnit,
            'language' => 'en',
            'options' => ['placeholder' => 'Pilih Kelas'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('<span>Đơn vị tính</span>'.Html::a('<i class="fa fa-plus-circle"></i>', ['/quantri/unit/create'], ['title' => 'Thêm đơn vị tính', 'style' => 'margin-left:10px','target' => '_blank','data' => ['pjax' => 0]]))  ?>

    

    <?= $form->field($model, 'bike_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), 
        [
            'data' => $dataMotor,
            'options' => ['placeholder' => 'Select a bike ...','multiple'=>true],
            'language' => 'en',
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('<span>Lắp cho xe</span>'.Html::a('<i class="fa fa-plus-circle"></i>', ['/quantri/motorbike/create'], ['title' => 'Thêm đơn vị tính', 'style' => 'margin-left:10px','target' => '_blank','data' => ['pjax' => 0]])) 
    ?>

    <?= $form->field($model, 'manu_id',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
        [
            'data' => $dataManu,
            'language' => 'en',
            'options' => ['placeholder' => 'Pilih Kelas'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('<span>Nhà sản xuất</span>'.Html::a('<i class="fa fa-plus-circle"></i>', ['/sanpham/manufacture/create'], ['title' => 'Thêm đơn vị tính', 'style' => 'margin-left:10px','target' => '_blank','data' => ['pjax' => 0]]))
    ?>

    

    <div class="clearfix"></div>
    
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group pull-right btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
