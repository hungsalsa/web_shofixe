<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\Tags */

$this->title = 'Update Tags: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->idtag]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tags-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
