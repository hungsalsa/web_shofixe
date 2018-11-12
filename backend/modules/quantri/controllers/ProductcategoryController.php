<?php

namespace backend\modules\quantri\controllers;

use Yii;
use backend\modules\quantri\models\ProductCategory;
use backend\modules\quantri\models\ProductCategorySearch;
use backend\modules\quantri\models\Group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductcategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductcategoryController extends Controller
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
     * Lists all ProductCategory models.
     * @return mixed
     */

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }


    public function actionIndex()
    {
        $searchModel = new ProductCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductCategory model.
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
     * Creates a new ProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductCategory();

        $dataCate = $model->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = array();
        }

        $group = new Group();
        $dataGroup = $group->getAllGroup();
        if(empty($dataGroup)){
            throw new NotFoundHttpException('Bạn hãy tạo nhóm trước khi tạo danh mục sản phẩm !');
        }

        $model->active = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

         if ($model->load($post = Yii::$app->request->post())) {
            if($post['ProductCategory']['cate_parent_id'] == ''){
                $model->cate_parent_id = 0;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->idCate]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataCate' => $dataCate,
            'dataGroup' => $dataGroup,
        ]);
    }

    /**
     * Updates an existing ProductCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $dataCate = $model->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = array();
        }

        $group = new Group();
        $dataGroup = $group->getAllGroup();
        if(empty($dataGroup)){
            throw new NotFoundHttpException('Bạn hãy tạo nhóm trước khi tạo danh mục sản phẩm !');
        }
// echo '<pre>';print_r($dataGroup);die;
        if(in_array('sản phẩm',$dataGroup)){die;
            // $dataGroup = [1=>'Sản phẩm'] ;
        }
        $model->updated_at = time();

        if ($model->load($post = Yii::$app->request->post())) {
            if($post['ProductCategory']['cate_parent_id'] == ''){
                $model->cate_parent_id = 0;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->idCate]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataCate' => $dataCate,
            'dataGroup' => $dataGroup,
        ]);
    }

    /**
     * Deletes an existing ProductCategory model.
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
     * Finds the ProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
