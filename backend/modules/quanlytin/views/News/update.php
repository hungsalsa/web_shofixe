<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\News */

$this->title = 'Chỉnh sửa tin : '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
        'dataNews' => $dataNews,
    ]) ?>

</div>
