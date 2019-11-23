<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\Videos */

$this->title = 'Chỉnh sửa Video : '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->idVideo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="videos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
    ]) ?>

</div>
