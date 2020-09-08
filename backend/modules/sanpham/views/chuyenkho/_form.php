<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductTransfer */
/* @var $form yii\widgets\ActiveForm */
$control = Yii::$app->controller->action->id;
$user = Yii::$app->user->identity; 
if($control == 'update' && $user->manager != 1){
    $dataCuahang = $dataChuyen;
    $disable = true;
    
    if ($model->status == 2) {
        $status = true;
        $disable_ch = true;
    }else {
        $status = false;
        $disable_ch = false;
    }
    
    // Nếu là cửa hàng nhập
    if (in_array($model->chuyenden_cuahang, json_decode($user->cuahang_id)) && $user->manager != 1) {
        $disable_ch = true;
        // $dataProduct = $dataAllProduct;
    }
}else {
       $disable_ch = false;
       $disable = false;
       $status = false;
}
$dataProduct = Yii::$app->cache->get('cache_app_danhsachsp_user');
?>

<div class="product-transfer-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'day',['options' => ['class' => 'col-md-2']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...','disabled' => $disable],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);?>

    <?= $form->field($model, "cuahang_id",['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'language' => 'en',
        'options' => ['placeholder' => 'Cửa hàng','disabled' => $disable_ch],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "chuyenden_cuahang",['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataChuyen,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas','disabled' => $disable],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


    <?php if ($disable == true): ?>
    <?= $form->field($model, 'day')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'cuahang_id')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'chuyenden_cuahang')->hiddenInput()->label(false); ?>
    <?php endif ?>
    <?= $form->field($model, 'type')->hiddenInput()->label(false); ?>
    

    <?= $form->field($model, 'ketoan',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
     ?>

    <?= $form->field($model, 'nhanvien',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataEmployee,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
     ?>
     <div class="clearfix"></div>

    <?= $form->field($model, 'status',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataStatus,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...','disabled'=>$status],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'note',['options' => ['class' => 'col-md-10']])->textInput(['maxlength' => true]) ?>
    <div class="clearfix"></div>
    <?php if ($status == true): ?>
    <?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
    <?php endif ?>
    <div class="row forminput">
        <div class="panel panel-default col-md-12">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Chi tiết chuyển kho</h4></div>
            <div class="panel-body">
               <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 50, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsProductTransferDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'pro_id',
                    'quantity',
                    'note',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsProductTransferDetail as $i => $modelProductTransferDetail): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Chuyển sản phẩm</h3>
                            <?php if (!$disable_ch): ?>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <?php endif ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $modelProductTransferDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelProductTransferDetail, "[{$i}]id");
                            }
                            ?>
                            
                            <div class="row">

                                <div class="col-sm-8">
                                    <?= $form->field($modelProductTransferDetail, "[{$i}]pro_id")->widget(Select2::classname(), [
                                        'data' => $dataProduct,
                                        'language' => 'en',
                                        'options' => ['placeholder' => 'Chọn sản phẩm','disabled' => $disable_ch,'class'=>'phutungchuyen'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]); ?>
                                </div>
                                <div class="col-sm-1">
                                    <?= $form->field($modelProductTransferDetail, "[{$i}]quantity")->textInput(['maxlength' => true,'type'=>'number']) ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelProductTransferDetail, "[{$i}]note")->textInput(['maxlength' => true]) ?>
                                </div>
                                <?php if ($disable_ch): ?>
                                    <?= $form->field($modelProductTransferDetail, "[{$i}]pro_id")->hiddenInput()->label(false); ?>
                                    <?= $form->field($modelProductTransferDetail, "[{$i}]quantity")->hiddenInput()->label(false); ?>
                                <?php endif ?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile('@web/js/checkchuyenkho.js', ['depends' => [\yii\web\JqueryAsset::class]] );