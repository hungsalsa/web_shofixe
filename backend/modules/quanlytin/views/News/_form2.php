<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use kartik\file\FileInput;
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <div class="white-box">
        <!-- Nav tabs -->
        <ul class="nav customtab nav-tabs" role="tablist">
            <li role="presentation" class="nav-item display-4"><a href="#home1" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Cơ bản </span></a></li>
            <li role="presentation" class="nav-item display-4"><a href="#profile1" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Chi tiết</span></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="home1">
                <?= $form->field($model, 'name',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>


                <?= $form->field($model, 'images',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 195x243 pixel']) ?>
                <div class="col-md-1" style="height: 80px">
                    <img src="<?= (isset($model->images))? Yii::$app->request->hostInfo.'/'.$model->images:''?>" id="previewImage" alt="" style="height: 100%">
                </div>

                <?= $form->field($model, 'image_category',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageMenu','placeholder'=>'Chọn ảnh 195x243 pixel']) ?>


                <?= $form->field($model, 'image_detail',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true]) ?>
                <div class="clearfix"></div>
                <?= $form->field($model, "category_id",['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
                    'data' => $dataCate,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Chọn danh mục cha'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                

                <?php // $form->field($model, 'related_products')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'related_news',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
                    'data' => $dataNews,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Chọn bài viết liên quan ...', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>

                <?= $form->field($model, 'sort',['options'=>['class'=>'col-md-1']])->textInput(['type'=>'number']) ?>

                <?= $form->field($model, 'hot',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
                    [
                        'initInputType' => CheckboxX::INPUT_CHECKBOX,
                        'options'=>['value' => $model->hot],
                        'autoLabel' => true
                    ])->label(false);
                    ?>
                    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
                        [
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['value' => $model->status],
                            'autoLabel' => true
                        ])->label(false);
                        ?>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile1">
                        <?= $form->field($model, 'htmltitle',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'title_slug'])?>
                        <?= $form->field($model, 'link',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>


                        <?= $form->field($model, 'htmlkeyword',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'htmldescriptions')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'content']) ?>
                        <div class="clearfix"></div>

                    </div>

                    <div class="form-group btn_save">
                        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
                    </div>

                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>


