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
    $posttk = $post['SuamaSearch'];
    $timkiem = $posttk['matim'];
    if ($posttk['masua'] != '') {
        $masua = $posttk['masua'];
    }
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

    <?= $form->field($model, 'matim',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true,'value' => (isset($timkiem)) ? $timkiem : null]) ?>
    <?= $form->field($model, 'masua',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true,'value' => (isset($masua)) ? $masua : null]) ?>
        

    <div class="form-group" style="padding-top: 18px;">
        <?= Html::submitButton('Search', ['name' => 'search', 'value' => 1,'class' => 'btn btn-primary ']) ?>
        <?= Html::a('Reset', ['suama'], ['class' => 'btn btn-success ']) ?>
        <?= Html::submitButton('Thay thế', ['name' => 'replace', 'value' => 1,'class' => 'btn btn-primary ','data' => [
            'confirm' => 'Bạn có chắc muốn sửa mã sản phẩm và dịch vụ']]) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
