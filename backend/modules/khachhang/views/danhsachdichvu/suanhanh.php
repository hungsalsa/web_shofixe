<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\Motorbike;
use kartik\select2\Select2;

$this->title = 'Danh sách dịch vụ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khachhang-dichvu-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới dịch vụ', ['create'], ['class' => 'btn btn-success button_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Dịch vụ từ {begin} -> {end} trong tổng {totalCount} dịch vụ",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        // 'rowOptions' => function ($model, $key, $index, $grid) {
        //     return [
        //         'style' => "cursor: pointer",
        //         'id' => $model['id'], 
        //         'onclick' => 'location.href="'
        //         . Yii::$app->urlManager->createUrl('khachhang/danhsachdichvu/view')
        //         . '?id="+(this.id);',
        //     ];
        // },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'madichvu',
            // 'tendv',
            [
                'attribute' =>'tendv',
                'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    if ($model->phutung == 1) {
                        return $model->tendv;
                    } else {
                        $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('tendv', $model->tendv, ['class'=>'form-control col-md-4','id'=>'tendv'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savetendv','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-5 m-3 Cancel','style'=>'margin:2px']).
                    
                "</div>";
                    return Html::tag('span',$model->tendv,$options = [
                        'data-field'=>'tendv',
                        'data-id'=>$key,
                        'id'=>'buttontendv'.$key,
                        'class'=>'text-info m-b-20 Quickchange change',
                    ]).$html;
                    }
                    
                },
            ],
            [
                'attribute' =>'guarantee',
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    if ($model->phutung == 1) {
                        return $model->guarantee;
                    } else {
                        $html = "<div class=\"updateProduct$key proUpdate\">".
                        Html::textInput('guarantee', $model->guarantee, ['type' => 'number','min' => 0,'class'=>'form-control col-md-4','id'=>'guarantee'.$key]).
                        Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 saveGuarantees','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                        Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).

                        "</div>";
                        return Html::button(Yii::$app->formatter->asDecimal($model->guarantee,0),$options = [
                            'data-field'=>'guarantee',
                            'data-id'=>$key,
                            'id'=>'buttonguarantee'.$key,
                            'class'=>'btn btn-default btn-outline m-b-20 Quickchange change',
                        ]).$html;
                    }
                },
            ],
            [
                'attribute' =>'price',
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    if ($model->phutung == 1) {
                        return $model->price;
                    } else {
                        $html = "<div class=\"updateProduct$key proUpdate\">".
                        Html::textInput('price', $model->price, ['type' => 'number','min' => 0,'class'=>'form-control col-md-4','id'=>'price'.$key]).
                        Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savePrices','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                        Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).

                        "</div>";
                        return Html::button(Yii::$app->formatter->asDecimal($model->price,0),$options = [
                            'data-field'=>'price',
                            'data-id'=>$key,
                            'id'=>'buttonPrice'.$key,
                            'class'=>'btn btn-default btn-outline m-b-20 Quickchange change',
                        ]).$html;
                    }
                },
            ],
            [
                'attribute' =>'price_sale',
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    if ($model->phutung == 1) {
                        return $model->price_sale;
                    } else {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('price_sale', $model->price_sale, ['type' => 'number','min' => 0,'class'=>'form-control col-md-4','id'=>'price_sale'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savePrice_sale','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
                    
                "</div>";
                    return Html::button(Yii::$app->formatter->asDecimal($model->price_sale,0),$options = [
                        'data-field'=>'price_sale',
                        'data-id'=>$key,
                        'id'=>'buttonPrice_sale'.$key,
                        'class'=>'btn btn-default btn-outline m-b-20 Quickchange change',
                    ]).$html;
                }
                },
            ],
            [
                'attribute' =>'status',
                // 'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use($data){
                    if ($model->phutung == 1) {
                        return $model->status;
                    } else {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Select2::widget([
                        'name' => 'status',
                        'value' => $model->status,
                        'data' => $data['status'],
                        'options' => [
                            'id'=>'status'.$key,
                            'placeholder' => 'Select provinces ...',
                        ],
                    ]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savestatus','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
                    "</div>";

                    return Html::tag('span',($model->status == 0) ? ' Hidden ' :' Active ',$options = [
                        'data-id'=>$key,
                        'data-field'=>'status',
                        'id'=>'buttonstatus'.$key,
                        'class'=>'text-info m-b-20 Quickchange change text-primary',
                    ]).$html;
                }
                },
            ],
            // 'price',
            // 'price_sale',
            'phutung',
            [
                'attribute'=>'xe_sd',
                'value'=>function ($data)
                {
                    $bike = new Motorbike();
                    return $bike->ReturnBikename(json_decode($data->xe_sd));
                }
            ],
            [
                'attribute' => 'user_add',
                'value'=>'user.fullname',
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i->d-m-Y']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['style' => 'font-size:18px','class'=>'actionColumn'],
                'visible'=> Yii::$app->user->isGuest ? false : true,
                'template' => '{view} {update} {delete} ',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('khachhang/danhsachdichvu/view'),
                    // 'update' => Yii::$app->user->can('khachhang/danhsachdichvu/update'),
                    'update' => function ($model, $key, $index) {
                        if($model->phutung != 1){
                            return Yii::$app->user->can('khachhang/danhsachdichvu/update');
                        }
                    },
                    'delete' => Yii::$app->user->can('khachhang/danhsachdichvu/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
