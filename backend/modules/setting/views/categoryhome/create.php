<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingCategoryHome */

$this->title = Yii::t('app', 'Create Setting Category Home');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setting Category Homes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-category-home-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCate' => $dataCate,
        'dataLocation' => $dataLocation,
        'dataProductType' => $dataProductType,
        'modelsProductType' => $modelsProductType,
    ]) ?>

</div>
