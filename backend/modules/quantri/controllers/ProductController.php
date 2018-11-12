<?php

namespace backend\modules\quantri\controllers;

use Yii;
use backend\modules\quantri\models\Product;
use backend\modules\quantri\models\ProductSearch;
use backend\modules\quantri\models\ProductCategory;
use backend\modules\quantri\models\Manufactures;
use backend\modules\quantri\models\Models;
use backend\modules\quantri\models\ProductType;
use backend\modules\quanlytin\models\News;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
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

        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
