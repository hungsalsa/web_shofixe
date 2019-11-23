<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\NewImages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="new-images-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_new')->textInput() ?>

    <?= $form->field($model, 'image_menu',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 195x243 pixel','data-target'=>'#myModal']) ?>
    <div class="col-md-1" style="height: 80px">
    	<img src="<?= (isset($model->image_menu))? Yii::$app->request->hostInfo.'/'.$model->image_menu:''?>" id="previewImage" alt="" style="height: 100%">
    </div>

    <?= $form->field($model, 'image_cate',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageMenu','placeholder'=>'Chọn ảnh 195x243 pixel','data-target'=>'#myModal2']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- /.modal --><!-- sample modal content -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="myModal2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4> </div>
            <div class="modal-body">
                <?php 
                    $user =  Yii::$app->user->identity->username;
                    $auth_key =  Yii::$app->user->identity->auth_key;
                    ?>
                <iframe  width="100%" height="450" frameborder="0"
                    src="../../../filemanager/dialog.php?type=1&field_id=imageFile&akey=<?= md5($user.$auth_key) ?>">
                </iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        /.modal-content
    </div>
    /.modal-dialog
</div> 
<!-- /.modal -->