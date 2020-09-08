<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
// use kartikorm\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChingaySearch */
/* @var $form yii\widgets\ActiveForm */
if ($post = Yii::$app->request->post()){
    $danhmuc = $post['NhanbanSearch']['danhmuc'];
    $cuahang = $post['NhanbanSearch']['cuahang'];
}
?>

<div class="chingay-search col-md-12">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
         'enableAjaxValidation' => false,
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, "cuahang",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $data['cuahang'],
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, "danhmuc",['options' => ['class' => 'col-md-6']])->widget(Select2::classname(), [
        'data' => $data['category'],
        'language' => 'en',
        'options' => ['placeholder' => 'chọn danh mục','multiple'=>true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
        

    <div class="form-group" style="padding-top: 18px;">
        <?= Html::submitButton('Search', ['name' => 'search', 'value' => 1,'class' => 'btn btn-primary ']) ?>
        <?= Html::a('Reset', ['suama'], ['class' => 'btn btn-success ']) ?>
        <?= Html::submitButton('Nhân bản bảng tồn', ['name' => 'replace', 'value' => 1,'class' => 'btn btn-primary ','data' => [
            'confirm' => 'Bạn có chắc muốn nhân bản sản phẩm và dịch vụ']]) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
