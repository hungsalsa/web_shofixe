<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuThieu */

$this->title = 'Create Phieu Thieu';
$this->params['breadcrumbs'][] = ['label' => 'Phieu Thieus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-thieu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'daygiao' => $daygiao,
        'sophieu' => $sophieu,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
