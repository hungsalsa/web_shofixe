<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuTon */

$this->title = 'Create Phieu Ton';
$this->params['breadcrumbs'][] = ['label' => 'Phieu Tons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-ton-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
