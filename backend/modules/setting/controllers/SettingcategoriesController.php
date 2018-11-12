<?php

namespace backend\modules\setting\controllers;

use Yii;
use backend\modules\setting\models\SettingCategories;
use backend\modules\quantri\models\Productcategory;
use backend\modules\setting\models\SettingCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SettingcategoriesController implements the CRUD actions for SettingCategories model.
 */
class SettingcategoriesController extends Controller
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
     * Lists all SettingCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SettingCategories model.
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
     * Creates a new SettingCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SettingCategories();
        $dataSetCate = $model->getParentSetCategory();

        $catProduct = new Productcategory();
        $dataLinkCat = $catProduct->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        
        if ($model->load($post = Yii::$app->request->post()) ) {
            
            if ($post['SettingCategories']['parent_id'] =='') {
                $model->parent_id = 0;
            }
            if($post['SettingCategories']['link_cate'] !=''){
                $model->slug_cate = $catProduct->getSlugcate($post['SettingCategories']['link_cate']);
            }

            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataSetCate' => $dataSetCate,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Updates an existing SettingCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $dataSetCate = $model->getParentSetCategory();
        
        $catProduct = new Productcategory();
        $dataLinkCat = $catProduct->getCategoryParent();
        
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        
        if ($model->load($post = Yii::$app->request->post()) ) {

            // echo '<pre>';print_r($post);die;

            // Sét parent_id = 0 neews ko chọn
            if ($post['SettingCategories']['parent_id']=='') {
                $model->parent_id = 0;
            }

            if($post['SettingCategories']['link_cate'] !=''){
                $model->slug_cate = $catProduct->getSlugcate($post['SettingCategories']['link_cate']);
            }
            // echo $model->slug_cate;die;

            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataSetCate' => $dataSetCate,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Deletes an existing SettingCategories model.
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
     * Finds the SettingCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SettingCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SettingCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
