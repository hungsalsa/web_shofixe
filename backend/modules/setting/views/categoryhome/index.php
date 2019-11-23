<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\ProductCategory;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\setting\models\SettingCategoryHomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Setting Category Homes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-category-home-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Setting Category Home'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'category_id',
            [
                'attribute' => 'category_id',
                'value' => function ($data)
                {
                    $cate = new ProductCategory();
                    $dataCate = $cate->getCategoryParent();
                    return $dataCate[$data->category_id];
                }
            ],
            // 'location',
            'status',
            'updated_at',
            //'user_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
