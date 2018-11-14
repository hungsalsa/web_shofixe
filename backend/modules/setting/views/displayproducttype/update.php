<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingDisplayProductType */

$this->title = Yii::t('app', 'Update Setting Display Product Type: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setting Display Product Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="setting-display-product-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
