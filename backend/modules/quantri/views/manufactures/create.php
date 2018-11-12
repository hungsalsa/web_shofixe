<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Manufactures */

$this->title = Yii::t('app', 'Create Manufactures');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manufactures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufactures-create">

    <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'seo' => $seo,
    ]) ?>

</div>
