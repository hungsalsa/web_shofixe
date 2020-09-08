<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\Motorbike;
use kartik\select2\Select2;
$this->title = 'Danh sách sản phẩm bạn Sửa nhanh';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1 class="pull-left"><?= Html::encode($this->title) ?></h1><h4 class="pull-right" style="margin-right: 200px"><?= Html::a('Cập nhật cửa hàng khác', ['updateproduct'], ['class' => 'btn btn-primary btn_luu']) ?></h4>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="clearfix"></div>
    <p class="pull-right btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
        <?= Html::a('Danh sách SP', ['suanhanh'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Sản phẩm từ {begin} -> {end} trong tổng {totalCount} sản phẩm",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        // 'rowOptions' => function ($model, $key, $index, $grid) {
        //     return [
        //         'style' => "cursor: pointer",
        //         'onclick' => 'location.href="'
        //         . Yii::$app->urlManager->createUrl('sanpham/product/view?id='.$model->id).'"'
        //     ];
        // },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'idPro',
            [
                'attribute' =>'proName',
                'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('proName', $model->proName, ['class'=>'form-control col-md-4','id'=>'proName'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 saveproName','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-5 m-3 Cancel','style'=>'margin:2px']).
                    
                "</div>";
                    return Html::tag('span',$model->proName,$options = [
                        'data-field'=>'proName',
                        'data-id'=>$key,
                        'id'=>'buttonproName'.$key,
                        'class'=>'text-info m-b-20 Quickchange change',
                    ]).$html;
                },
            ],

            // [
            //     'attribute'=>'manu_id',
            //     'value'=>'nhasanxuat.manuName',
            // ],
            [
                'attribute' => 'cuahang_id',
                'value'=>'cuahang.name',
            ],
            [
                'attribute'=>'cate_id',
                'value'=>'category.cateName',
            ],
            /*[
                'attribute' =>'location',
                // 'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use($data){
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Select2::widget([
                        'name' => 'location',
                        'value' => ($model->location == '') ? false:$model->location,
                        'data' => $data['location'],
                        'options' => [
                            'id'=>'location'.$key,
                            'placeholder' => 'Select provinces ...',
                        ],
                    ]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savelocation','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-5 m-3 Cancel','style'=>'margin:2px']).
                    "</div>";

                    return Html::tag('span',($model->location == 0) ? 'Chưa có' :$model->vitri->name,$options = [
                        'data-id'=>$key,
                        'data-field'=>'location',
                        'id'=>'buttonlocation'.$key,
                        'class'=>'text-info m-b-20 Quickchange change text-primary',
                    ]).$html;
                },
            ],*/
            // 'guarantee',
            [
                'attribute' =>'guarantee',
                // 'format'=>'html',
                'content' => function($model,$key,$index, $column) {
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
                },
            ],
            [
                'attribute' =>'price',
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
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
                },
            ],
            [
                'attribute' =>'price_sale',
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
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
                },
            ],
            // 'note:ntext',
            // 'status',
            [
                'attribute' =>'status',
                // 'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use($data){
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
                },
            ],
            // [
            //     'attribute' => 'created_at',
            //     'format' => ['date', 'php:d-m-Y']
            // ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            //'created_at',
            // [
            //     'attribute'=>'user_add',
            //     'value'=>'user.username',
            // ],
            [
                'attribute' =>'bike_id',
                // 'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use($data){

                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Select2::widget([
                        'name' => 'bike_id',
                        'value' => json_decode($model->bike_id),
                        'data' => $data['bike_id'],
                        'options' => [
                            'id'=>'bike_id'.$key,
                            'placeholder' => 'Select provinces ...',
                            'multiple'=>true
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savebike_id','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/sanpham/product/quickchange']),'data-id'=>$key,'data-field'=>'bike_id']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
                    "</div>";
                    $bike = new Motorbike();
                    return Html::tag('span',($model->bike_id !='') ? $bike->ReturnBikename(json_decode($model->bike_id)) :' Chưa có ',$options = [
                        'data-id'=>$key,
                        'data-field'=>'bike_id',
                        'id'=>'buttonbike_id'.$key,
                        'class'=>'text-info m-b-20 Quickchange change text-primary',
                    ]).$html;
                },
            ],
            //'cate_id',
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
              'contentOptions' => ['style' => 'font-size:18px','class'=>'actionColumn'],
              'visible'=> Yii::$app->user->isGuest ? false : true,
              'template' => '{view} {update} {delete} ',
              'visibleButtons' => [
                    'view' => Yii::$app->user->can('sanpham/product/view'),
                    'update' => Yii::$app->user->can('sanpham/product/update'),
                    'delete' => Yii::$app->user->can('sanpham/product/delete')
                ],
            ],
         

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php $this->registerJsFile('@web/js/product/product_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>
