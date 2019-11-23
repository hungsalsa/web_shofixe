<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;

?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <div class="white-box">
        <!-- Tab panes -->
        <div role="tabpanel" class="tab-pane fade active in" id="home1">
            <?= $form->field($model, 'name',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'title_slug']) ?>

            <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>
            <?= $form->field($model, 'images',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 470x300 pixel']) ?>
            <?php if ($this->context->action->id=='update'): ?>
                
                <div class="col-md-1" style="height: 80px">
                    <img src="<?= (isset($model->images))? Yii::$app->request->hostInfo.'/'.$model->images:''?>" id="previewImage" alt="" style="height: 100%;width: 90%">
                </div>
            <?php endif ?>

            
            <?= $form->field($model, 'hot',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
                'data' => [2 => '- Slide 1 -',1=>'- Slide 2 -'],
                'language' => 'en',
                'options' => ['placeholder' => 'Chọn vị trí nổi bật', 'multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
            
            <?= $form->field($model, "category_id",['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
                'data' => $dataCate,
                'language' => 'en',
                'options' => ['placeholder' => 'Chọn danh mục cha'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
            
            <?= $form->field($model, 'sort',['options'=>['class'=>'col-md-1']])->textInput(['placeholder' => 'Rỗng = 1']) ?>
            

            <?= $form->field($model, 'see_more',['options' => ['class' => 'has-success activeform col-md-2']])->widget(CheckboxX::classname(),
                [
                    'initInputType' => CheckboxX::INPUT_CHECKBOX,
                    'options'=>['value' => $model->see_more],
                    'autoLabel' => false
                ])->label(false);
                ?>
                <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
                    [
                        'initInputType' => CheckboxX::INPUT_CHECKBOX,
                        'options'=>['value' => $model->status],
                        'autoLabel' => true
                    ])->label(false);
                    ?>

                    <?php // $form->field($model, 'related_products')->textInput(['maxlength' => true]) ?>

                    <div class="clearfix"></div>
                    <?= $form->field($model, 'related_news')->widget(Select2::classname(), [
                        'data' => $dataNews,
                        'language' => 'en',
                        'options' => ['placeholder' => 'Chọn bài viết liên quan ...', 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);?>

                    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true])?>
                    

                    <?= $form->field($model, 'seo_descriptions',['options'=>['class'=>' paddinglefright75']])->textarea(['rows' => 4]) ?>
                    <?= $form->field($model, 'seo_keyword')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'short_description',['options'=>['class'=>' paddinglefright75']])->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'content',['options'=>['class'=>'paddinglefright75']])->textarea(['rows' => 8,'class'=>'content']) ?>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group btn_save">
                    <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
                    <?= Html::a('Cancel', ['/quanlytin/news'], ['class'=>'btn btn-primary btn_luu']) ?>
                </div>

            </div>

            <?php ActiveForm::end(); ?>

        </div>


