<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\ImgproList */

$this->title = Yii::t('app', 'Create Imgpro List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Imgpro Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imgpro-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
