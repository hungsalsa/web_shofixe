<?php

namespace backend\modules\sanpham\controllers;

use Yii;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\sanpham\models\ProductCateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ProductcateController implements the CRUD actions for ProductCate model.
 */
class ProductcateController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    // 'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all ProductCate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductCateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductCate model.
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
     * Creates a new ProductCate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductCate();
        $user = Yii::$app->user->identity; 
         if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền xóa');
        }

        $dataCate = $model->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = [];
        }

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {
            if($post['ProductCate']['parent_id'] == ''){
                $model->parent_id = 0;
            }
            $model->cateName = ucfirst($post['ProductCate']['cateName']);
            if($model->save())
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'dataCate' => $dataCate,
        ]);
    }

    /**
     * Updates an existing ProductCate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity; 
         if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền xóa');
        }

        $dataCate = $model->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = [];
        }

        if ($model->load($post = Yii::$app->request->post()) ) {
            if($post['ProductCate']['parent_id'] == ''){
                $model->parent_id = 0;
            }
            $model->cateName = ucfirst($post['ProductCate']['cateName']);
            if($model->save())
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'dataCate' => $dataCate,
        ]);
    }

    /**
     * Deletes an existing ProductCate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = Yii::$app->user->identity; 
         if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền xóa');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductCate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductCate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductCate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return json_decode($user->cuahang_id);

       }
       throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
   }
}
