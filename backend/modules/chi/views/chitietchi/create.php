<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chitietchi */

$this->title = 'Create Chitietchi';
$this->params['breadcrumbs'][] = ['label' => 'Chitietchis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chitietchi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
