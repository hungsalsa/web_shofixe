<?php 
use yii\helpers\Url;
use yii\grid\GridView;

$form = \yii\widgets\ActiveForm::begin([
        'options' => ['role' => 'form', 'method' => 'GET', 'action' => Url::to(['site/search'])]
    ]); ?>

    <?=$form->field($model, 'query')?>

    <?=\yii\helpers\Html::submitButton('Поиск')?>

<?php $form->end()?>

<? if ($productDataProvider->totalCount): ?>
    <?= GridView::widget([
        'dataProvider' => $productDataProvider,
        'columns' => [
            'id',
            'name'
        ],
    ]) ?>
<? else: ?>
    <p>Ничего не найдено</p>
<? endif; ?>