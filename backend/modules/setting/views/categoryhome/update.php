<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingCategoryHome */

$this->title = Yii::t('app', 'Update Setting Category Home: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setting Category Homes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="setting-category-home-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
        'dataLocation' => $dataLocation,
        'dataProductType' => $dataProductType,
        'modelsProductType' => $modelsProductType,
    ]) ?>

</div>
