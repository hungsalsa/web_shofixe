<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

// use kartikorm\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChingaySearch */
/* @var $form yii\widgets\ActiveForm */
$dataKhachhang =\Yii::$app->cache->get('Cache_dataKhachhang');
?>

<div class="chingay-search col-md-12">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'action' => ['index'],
        // 'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= $form->field($model, 'khachhang',['options'=>['class'=>'col-md-10']])->widget(Select2::classname(), [
        'data' => $dataKhachhang,
        'options' => ['placeholder' => 'Enter customer information ...','id'=>'cat-id'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'xe_kh',['options'=>['class'=>'col-md-2']])->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat-id'],
        'type' => DepDrop::TYPE_SELECT2,
        // 'data' => [],
        // 'data'=>[],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/khachhang/thongkexe/subcat'])
        ]
    ]); ?>
    <div class="clearfix"></div>



    <div class="form-group">
        <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary btn_luu','id'=>'timkiemKH']) ?>
        <?php if (!$_POST): ?>
            <?= Html::a('Thêm Khách hàng', ['/khachhang/khachhang/create'], ['class' => 'btn btn-info btn_luu']) ?>
        <?php else: $idKH = $_POST['ThongkexeSearch']['khachhang'];?>
            <?= Html::a('Thêm DV', ['/khachhang/khachhangdichvu/create','idKH'=>$idKH], ['class' => 'btn btn-success btn_luu']) ?>
            <?= Html::a('Cập nhật khách hàng', ['/khachhang/khachhang/update','id'=>$idKH], ['class' => 'btn btn-warning btn_luu']) ?>
        <?php endif ?>
        <?= Html::a('Nhấn vào đây nếu ko thấy', ['/khachhang/thongkexe/resetcache'], [
            'class' => 'btn btn-danger button_luu pull-right btn-outline-warning',
            // 'data' => [
            //     'method' => 'post',
            //     'params' => ['resetcache' => true]
            // ]
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
