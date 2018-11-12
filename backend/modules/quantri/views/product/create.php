<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
        'dataManu' => $dataManu,
        'dataModels' => $dataModels,
        'dataProtype' => $dataProtype,
        'dataProduct' => $dataProduct,
        'dataNews' => $dataNews,
    ]) ?>

</div>
