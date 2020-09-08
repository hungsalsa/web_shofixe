<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$this->title = 'Thêm mới User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <!-- <div class="col-lg-5"> -->
            <?php $form = ActiveForm::begin(['id' => 'form-signup','enableClientValidation' => true, 'enableAjaxValidation' => true]); ?>

                <?= $form->field($model, 'username',['options'=>['class'=>'col-md-3']])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'fullname',['options'=>['class'=>'col-md-3']])->textInput() ?>

                <?= $form->field($model, 'email',['options'=>['class'=>'col-md-3']]) ?>

                <?= $form->field($model, 'password',['options'=>['class'=>'col-md-3']])->passwordInput() ?>

                <?= $form->field($model, 'compare_password',['options'=>['class'=>'col-md-3']])->passwordInput() ?>

                <?= $form->field($model, "view_cuahang",['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
                    'data' => [0 =>'-Không-', 1 => 'Là người xem'],
                    'language' => 'en',
                    'options' => ['placeholder' => 'Chọn 1'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>

                <?= $form->field($model, "manager",['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
                    'data' => [0 =>'-Không-', 1 => 'Là Quản lý'],
                    'language' => 'en',
                    'options' => ['placeholder' => 'Chọn 1'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                

                <?= $form->field($model, "permission",['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
                    'data' => $authItems,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Chọn 1'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>


                <div class="form-group">
                    <?= Html::submitButton('Thêm mới', ['class' => 'btn btn-primary button_luu', 'name' => 'signup-button','style'=>'margin-top: 20px']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        <!-- </div> -->
    </div>
</div>
