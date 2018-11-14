<?php

namespace backend\modules\quantri\controllers;

use Yii;
use backend\modules\quantri\models\Product;
use backend\modules\quantri\models\ImgproList;
use backend\modules\quantri\models\ProductSearch;
use backend\modules\quantri\models\ProductCategory;
use backend\modules\quantri\models\Manufactures;
use backend\modules\quantri\models\Models;
use backend\modules\quantri\models\ProductType;
use backend\modules\quantri\models\SeoUrl;
use backend\modules\quanlytin\models\News;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        $dataProduct = $model->getAllProduct();
        if(empty($dataProduct)){
            $dataProduct = [];
        }

        $cate = new ProductCategory();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            throw new NotFoundHttpException('Bạn hãy tạo danh mục sản phẩm trước khi thêm sản phẩm !');
        }

        $man = new Manufactures();
        $dataManu = $man->getAllManufacture();
        if(empty($dataManu)){
            throw new NotFoundHttpException('Bạn hãy tạo nhà sản xuất trước khi thêm sản phẩm !');
        }
        
        $xe = new Models();
        $dataModels = $xe->getAllModels();
        if(empty($dataModels)){
            $dataModels = [];
        }
        
        $loaisp = new ProductType();
        $dataProtype = $loaisp->getAllProductType();
        if(empty($dataProtype)){
            $dataProtype = [];
        }

        $new = new News();
        $dataNews = $new->getAllNews();
        if(empty($dataNews)){
            $dataNews = [];
        }

        $model->active = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        $modelsImgproList = [new ImgproList];

        if ($model->load($post = Yii::$app->request->post())) {

            if ($post['Product']['image']!='') {
                $model->image = str_replace(Yii::$app->request->hostInfo.'/','',$post['Product']['image']);
            }

            if (!empty($post['Product']['models_id'])) {
                 $model->models_id = json_encode($post['Product']['models_id']);
            }
            if (!empty($post['Product']['tags'])) {
                 $model->tags = json_encode($post['Product']['tags']);
            }
            if (!empty($post['Product']['related_articles'])) {
                 $model->related_articles = json_encode($post['Product']['related_articles']);
            }
            if (!empty($post['Product']['related_products'])) {
                 $model->related_products = json_encode($post['Product']['related_products']);
            }

            // echo '<pre>';print_r($post);die;
            if($post['Product']['slug'] !=''){
                $seo->slug = $post['Product']['slug'];
            }

            if($model->save()){
                $seo->query = 'product_id='.$model->id;
                $seo->save();
                unset($post);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataCate' => $dataCate,
            'dataManu' => $dataManu,
            'dataModels' => $dataModels,
            'dataProtype' => $dataProtype,
            'dataProduct' => $dataProduct,
            'dataNews' => $dataNews,
            'modelsImgproList' => (empty($modelsImgproList)) ? [new ImgproList] : $modelsImgproList
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $seo = new SeoUrl();
        $idseo = $seo->getId($model->slug);
        if($idseo){
            $seo = SeoUrl::findOne($idseo);
            unset($idseo);
        }

        $dataProduct = $model->getAllProduct();
        if(empty($dataProduct)){
            $dataProduct = [];
        }

        $cate = new ProductCategory();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            throw new NotFoundHttpException('Bạn hãy tạo danh mục sản phẩm trước khi thêm sản phẩm !');
        }

        $man = new Manufactures();
        $dataManu = $man->getAllManufacture();
        if(empty($dataManu)){
            throw new NotFoundHttpException('Bạn hãy tạo nhà sản xuất trước khi thêm sản phẩm !');
        }
        
        $xe = new Models();
        $dataModels = $xe->getAllModels();
        if(empty($dataModels)){
            $dataModels = [];
        }
        
        $loaisp = new ProductType();
        $dataProtype = $loaisp->getAllProductType();
        if(empty($dataProtype)){
            $dataProtype = [];
        }

        $new = new News();
        $dataNews = $new->getAllNews();
        if(empty($dataNews)){
            $dataNews = [];
        }

        if($model->product_type_id !=''){
           $model->product_type_id = json_decode($model->product_type_id);
        }

        if($model->models_id !=''){
             $model->models_id = json_decode($model->models_id);
        }

        if($model->tags !=''){
            $model->tags = json_decode($model->tags);
        }
        if($model->related_articles !=''){
            $model->related_articles = json_decode($model->related_articles);
        }
        if($model->related_products !=''){
            $model->related_products = json_decode($model->related_products);
        }
        

        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {

            if ($post['Product']['image']!='') {
                $model->image = str_replace(Yii::$app->request->hostInfo.'/','',$post['Product']['image']);
            }


            if (!empty($post['Product']['product_type_id'])) {
                 $model->product_type_id = json_encode($post['Product']['product_type_id']);
            }
            if (!empty($post['Product']['models_id'])) {
                 $model->models_id = json_encode($post['Product']['models_id']);
            }
            if (!empty($post['Product']['tags'])) {
                 $model->tags = json_encode($post['Product']['tags']);
            }
            if (!empty($post['Product']['related_articles'])) {
                 $model->related_articles = json_encode($post['Product']['related_articles']);
            }
            if (!empty($post['Product']['related_products'])) {
                 $model->related_products = json_encode($post['Product']['related_products']);
            }

            // echo '<pre>';print_r($post);die;

            $seo->slug = $post['Product']['slug'];

            if($model->save()){
                $seo->query = 'product_id='.$model->id;
                $seo->save();
                unset($post);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
            'model' => $model,
            'dataCate' => $dataCate,
            'dataManu' => $dataManu,
            'dataModels' => $dataModels,
            'dataProtype' => $dataProtype,
            'dataProduct' => $dataProduct,
            'dataNews' => $dataNews,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
