<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Manufactures */

$this->title = Yii::t('app', 'Chỉnh sửa : '.$model->ManName, [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manufactures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->idMan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="manufactures-update">

    <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'seo' => $seo,
    ]) ?>

</div>
