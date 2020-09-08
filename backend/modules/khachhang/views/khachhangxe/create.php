<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhXe */

$this->title = 'Create Kh Xe';
$this->params['breadcrumbs'][] = ['label' => 'Kh Xes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kh-xe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
