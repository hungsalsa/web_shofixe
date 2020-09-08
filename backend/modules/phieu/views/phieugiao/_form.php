<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;
// use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuGiao */
/* @var $form yii\widgets\ActiveForm */
$control = Yii::$app->controller->action->id;
$options = [
    'placeholder' => ' .... data select ...',
];
if($control == 'update'){
    $options = [
        'disabled' => true
    ];
}
?>

<div class="phieu-giao-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true,
        // 'validationUrl'=>Url::toRoute('phieugiao/validation')
    ]); ?>

    <?= $form->field($model, 'ngay_giao',['options' => ['class' => 'col-md-3']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => ' .... data select ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy', 
            'todayHighlight' => true
        ]
    ]);?>

    <?= $form->field($model, "cuahang_id",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'language' => 'en',
        'options' => ['placeholder' => ' .... data select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "status",['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => [1=>'Xuất luôn',0=>'Lưu tạm'],
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn trang thái'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, "nguoi_giao",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, "nguoi_nhan",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'sophieu_dau',['options' => ['class' => 'col-md-3']])->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'sophieu_cuoi',['options' => ['class' => 'col-md-3']])->textInput(['type'=>'number']) ?>

    <div class="clearfix"></div>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group btn_save">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
