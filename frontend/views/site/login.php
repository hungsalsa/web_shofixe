<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sign-in-page inner-bottom-sm">
    <div class="row">
        <!-- Sign-in -->            
        <div class="col-md-6 col-sm-6 sign-in">
            <h4 class="">sign in</h4>
            <p class="">Hello, Welcome to your account.</p>
            <div class="social-sign-in outer-top-xs">
                <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
            </div>
            <!-- <form class="register-form outer-top-xs" role="form"> -->
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'register-form outer-top-xs',"role" => "form"]]); ?>
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">username <span>*</span></label>
                    <?= $form->field($model, 'username',['options' => ['class' => 'form-control unicase-form-control text-input']])->textInput(['autofocus' => true,"id" => "exampleInputEmail1"]) ?>
                </div>
                <div class="form-group">
                    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" >
                </div>
                <div class="radio outer-xs">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember me!
                    </label>
                    <a href="#" class="forgot-password pull-right">Forgot your Password?</a>
                </div>
                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
            <!-- </form>                  -->
            <?php ActiveForm::end(); ?>
        </div>
        <!-- Sign-in -->

        <!-- create a new account -->
        <div class="col-md-6 col-sm-6 create-new-account">
            <h4 class="checkout-subtitle">create a new account</h4>
            <p class="text title-tag-line">Create your own Unicase account.</p>
            <form class="register-form outer-top-xs" role="form">
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" >
                </div>
                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
            </form>
            <span class="checkout-subtitle outer-top-xs">Sign Up Today And You'll Be Able To :  </span>
            <div class="checkbox">
                <label class="checkbox">
                    <input type="checkbox" id="speed" value="option1"> Speed your way through the checkout.
                </label>
                <label class="checkbox">
                    <input type="checkbox" id="track" value="option2"> Track your orders easily.
                </label>
                <label class="checkbox">
                    <input type="checkbox" id="keep" value="option3"> Keep a record of all your purchases.
                </label>
            </div>
        </div>  
        <!-- create a new account -->           
    </div><!-- /.row -->
</div><!-- /.sigin-in-->