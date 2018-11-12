<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Ban */

$this->title = 'Create Ban';
$this->params['breadcrumbs'][] = ['label' => 'Bans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ban-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
