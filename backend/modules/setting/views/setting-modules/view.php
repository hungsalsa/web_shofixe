<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingModules */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Setting Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-modules-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            'cate_id',
            'page_show',
            'sort',
            'positions',
            'content:ntext',
            'created_at',
            'updated_at',
            'user_add',
            'user_edit',
        ],
    ]) ?>

</div>
