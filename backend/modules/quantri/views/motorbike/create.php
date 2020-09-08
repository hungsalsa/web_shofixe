<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Motorbike */

$this->title = 'Thêm mới xe';
$this->params['breadcrumbs'][] = ['label' => 'Motorbikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorbike-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataHangxe' => $dataHangxe,
    ]) ?>

</div>
