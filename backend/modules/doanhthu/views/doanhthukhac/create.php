<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhthuKhac */

$this->title = 'Thêm khoản thu khác';
$this->params['breadcrumbs'][] = ['label' => 'Doanhthu Khacs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanhthu-khac-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
