<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\NewImages */

$this->title = 'Create New Images';
$this->params['breadcrumbs'][] = ['label' => 'New Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
