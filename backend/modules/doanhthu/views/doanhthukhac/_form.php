<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;
/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhthuKhac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doanhthu-khac-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'doanhthu_id')->hiddenInput()->label(false); ?>
<?php // $form->field($model, 'doanhthu_id',['options' => ['class' => 'col-md-4']])->dropDownList($doanhthuAll)->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'money',['options'=>['class'=>'col-md-4']])->widget(NumberControl::classname(), [
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
    <div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
