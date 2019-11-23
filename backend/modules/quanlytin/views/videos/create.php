<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\Videos */

$this->title = 'Thêm mới Video';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
    ]) ?>

</div>
