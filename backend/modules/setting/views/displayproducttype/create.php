<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingDisplayProductType */

$this->title = Yii::t('app', 'Create Setting Display Product Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Setting Display Product Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-display-product-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
