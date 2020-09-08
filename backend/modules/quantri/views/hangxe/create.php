<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Hangxe */

$this->title = 'Create Hangxe';
$this->params['breadcrumbs'][] = ['label' => 'Hangxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hangxe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
