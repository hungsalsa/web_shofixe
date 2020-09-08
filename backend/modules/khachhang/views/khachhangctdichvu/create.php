<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhChitietDv */

$this->title = 'Create Kh Chitiet Dv';
$this->params['breadcrumbs'][] = ['label' => 'Kh Chitiet Dvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kh-chitiet-dv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
