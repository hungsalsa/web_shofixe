<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Models */

$this->title = Yii::t('app', 'Create Models');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-create">

    <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'seo' => $seo,
    ]) ?>

</div>