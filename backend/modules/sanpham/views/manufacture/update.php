<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Manufacture */

$this->title = 'Chỉnh sửa nhà sản xuất : '.$model->manuName;
$this->params['breadcrumbs'][] = ['label' => 'Manufactures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manufacture-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
