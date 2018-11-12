<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pro_name') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'keyword') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'short_introduction') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_sales') ?>

    <?php // echo $form->field($model, 'start_sale') ?>

    <?php // echo $form->field($model, 'end_sale') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'product_type_id') ?>

    <?php // echo $form->field($model, 'salse') ?>

    <?php // echo $form->field($model, 'hot') ?>

    <?php // echo $form->field($model, 'best_seller') ?>

    <?php // echo $form->field($model, 'manufacturer_id') ?>

    <?php // echo $form->field($model, 'guarantee') ?>

    <?php // echo $form->field($model, 'models_id') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'images_list') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'product_category_id') ?>

    <?php // echo $form->field($model, 'related_articles') ?>

    <?php // echo $form->field($model, 'related_products') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
