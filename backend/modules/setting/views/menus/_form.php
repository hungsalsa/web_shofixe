<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\Menus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menus-form">

    <?php $form = ActiveForm::begin(); ?>
    

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'title_slug'])?>
    <?= $form->field($model, 'slug',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>


     <?php 
    echo $form->field($model, 'type',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data' => $menuType,
            'language' => 'en',
            'options' => [
                'placeholder' => 'Select a Type ...',
                'onchange' => 
                    '$.get( "'.Url::toRoute('/setting/menus/lists').'", { id: $(this).val() } )
                        .done(function( data ) {
                            $( "#'.Html::getInputId($model, 'link_cate').'" ).html( data );
                        }
                    );'
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'link_cate',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
            'data' => $dataLinkCat,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    
    <?= $form->field($model, 'parent_id',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data' => $dataMenus,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    

    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Click chọn ảnh']) ?>
    <div class="col-md-1" style="height: 80px">
        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 100%">
    </div>

    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-2']])->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>

    
    <div class="clearfix"></div>
    <?= $form->field($model, 'introduction')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
