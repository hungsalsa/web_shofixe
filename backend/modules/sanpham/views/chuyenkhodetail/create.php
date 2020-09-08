<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductTransferDetail */

$this->title = 'Create Product Transfer Detail';
$this->params['breadcrumbs'][] = ['label' => 'Product Transfer Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-transfer-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
