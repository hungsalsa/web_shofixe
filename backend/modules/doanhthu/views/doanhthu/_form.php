<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use kartik\number\NumberControl;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhThu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doanh-thu-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'ngay',['options' => ['class' => 'col-md-3']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy'
        ]
    ]);?>
    <?=
     $form->field($model, 'cua_hang',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'options' => ['placeholder' => '-- Làm tại --'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model, 'ketoan',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'options' => ['placeholder' => '-- Thu ngân --'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'nguoi_ky',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'options' => ['placeholder' => '-- Người QL --'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'giao_sang',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
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
    <?= $form->field($model, 'tt_ck',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
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
    <?= $form->field($model, 'tt_the',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
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
<?= $form->field($model, 'tt_tien_mat',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
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
<?= $form->field($model, 'tien_hom',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
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
<?= $form->field($model, 'tien_le',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
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

     <?php $form->field($model, 'tien_chi',['options'=>['class'=>'col-md-2']])->widget(NumberControl::classname(), [
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

     <?= $form->field($model, 'status',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => [0 => 'Lưu tạm',1=>'Xuất luôn'],
        'options' => ['placeholder' => '-- Select a type --'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    
    <?php // $form->field($model, 'chenh_lech',['options'=>['class'=>'col-md-2']])->textInput() ?>

    <div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

        <?php // $form->field($model, 'tong_doanh_thu_phieu',['options'=>['class'=>'col-md-2']])->textInput() ?>

    <?php // $form->field($model, 'doanh_thu_thuc',['options'=>['class'=>'col-md-2']])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
