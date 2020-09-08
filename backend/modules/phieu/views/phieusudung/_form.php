<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSudung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-sudung-form">
    <?php $action =  Yii::$app->controller->action->id; ?>
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'ngay_sd',['options' => ['class' => 'col-md-3']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);?>

    <?= $form->field($model, "cuahang_id",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "so_phieu_dau",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data'=> $datasophieu,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, "so_phieu_cuoi",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data'=> $datasophieu,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="clearfix"></div>
    <?= $form->field($model, 'sl_phieu_tot',['options' => ['class' => 'col-md-3']])->textInput() ?>

    <?= $form->field($model, "ke_toan",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data'=> $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "quan_ly",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data'=> $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    
    <?= $form->field($model, 'status',['options' => ['class' => 'status_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
        ?>

        <div class="clearfix"></div>
        <?= $form->field($model, "phieu_ton",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data'=> $datasophieu,
            'language' => 'en',
            'options' => ['placeholder' => 'Pilih Kelas','multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>


        <?= $form->field($model, "phieu_huy",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data'=> $datasophieu,
            'language' => 'en',
            'options' => ['placeholder' => 'Pilih Kelas','multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?= $form->field($model, "phieu_ton_tt",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data'=> $dataPhieuton,
            'language' => 'en',
            'options' => ['placeholder' => 'Pilih Kelas','multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <div class="clearfix"></div>
        <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
