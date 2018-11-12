<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\Menus */

$this->title = 'Create Menus';
$this->params['breadcrumbs'][] = ['label' => 'Menuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataMenus' => $dataMenus,
        'menuType' => $menuType,
        'dataLinkCat' => $dataLinkCat,
    ]) ?>

</div>
