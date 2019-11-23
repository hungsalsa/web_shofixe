<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\News */

$this->title = 'Thêm mới tin tức';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
        'dataNews' => $dataNews,
    ]) ?>

</div>
