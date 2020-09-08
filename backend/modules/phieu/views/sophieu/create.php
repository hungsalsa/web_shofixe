<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSophieu */

$this->title = 'Create Phieu Sophieu';
$this->params['breadcrumbs'][] = ['label' => 'Phieu Sophieus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-sophieu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
