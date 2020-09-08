<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\CuaHang */

$this->title = 'Create Cua Hang';
$this->params['breadcrumbs'][] = ['label' => 'Cua Hangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cua-hang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
