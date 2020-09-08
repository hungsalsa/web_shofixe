<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Motorbike */

$this->title = 'Chỉnh sửa xe';
$this->params['breadcrumbs'][] = ['label' => 'Motorbikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="motorbike-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataHangxe' => $dataHangxe,
    ]) ?>

</div>
