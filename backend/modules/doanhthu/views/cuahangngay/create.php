<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\CuahangNgay */

$this->title = 'Create Cuahang Ngay';
$this->params['breadcrumbs'][] = ['label' => 'Cuahang Ngays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuahang-ngay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
