<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Unit */

$this->title = 'THÊM MỚI ';
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
