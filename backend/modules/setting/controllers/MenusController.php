<?php

namespace backend\modules\setting\controllers;

use Yii;
use backend\modules\setting\models\Menus;
use backend\modules\setting\models\MenusSearch;
use backend\modules\quantri\models\Productcategory;
use backend\modules\quantri\models\Categories;
use backend\modules\quantri\models\Pages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenusController implements the CRUD actions for Menus model.
 */
class MenusController extends Controller
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
     * Lists all Menus models.
     * @return mixed
     */
    public function beforeAction($action) 
{ 
    $this->enableCsrfValidation = false; 
    return parent::beforeAction($action); 
}
    public function actionIndex()
    {
        $searchModel = new MenusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menus model.
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
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menus();

        $dataMenus = $model->getMenuParent();
        $menuType = array(
            1 => 'Danh mục sản phẩm',
            2 => 'Danh mục bài viết',
            3 => 'Trang nội dung'
        );
        $dataLinkCat = array();

        $model->created_at = time();
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }
        if ($model->load($post = Yii::$app->request->post()) ) {
            if ($post['Menus']['parent_id'] == '') {
                $model->parent_id = 0;
            }
            // echo $model->parent_id;
            // echo '<pre>';print_r($post);die;
            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataMenus' => $dataMenus,
            'menuType' => $menuType,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $menu = new Menus();
        $dataMenus = $menu->getMenuParent();


        $menuType = array(
            1 => 'Danh mục sản phẩm',
            2 => 'Danh mục bài viết',
            3 => 'Trang nội dung'
        );


        if($model->type == 1){
            $catProduct = new Productcategory();
            $dataLinkCat = $catProduct->getCategoryParent();
            if(empty($dataLinkCat)){
                $dataLinkCat = array();
            }
        }else if($model->type == 2){
            $categories = new Categories();
            $dataLinkCat = $categories->getCategoryParent();
            if(empty($dataLinkCat)){
                $dataLinkCat = array();
            }
        }else {
            $page = new Pages();
            $dataLinkCat = $page->getPageAll();
            if(empty($dataLinkCat)){
                $dataLinkCat = array();
            }
        }

        
        // echo $dataLinkCat[$model->link_cate];
        // echo $model->type;
        // print_r($dataLinkCat);
        // echo $model->link_cate;die;
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {
            if ($post['Menus']['parent_id'] =='') {
                $model->parent_id = 0;
            }
        // echo '<pre>';print_r($post);die;

            // if (!empty($post['Product']['models_id'])) {
            //     $models_ids = $post['Product']['models_id'];
            //     $model->models_id = json_encode($models_ids);
            // }
            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataMenus' => $dataMenus,
            'menuType' => $menuType,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Deletes an existing Menus model.
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
     * Finds the Menus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLists($id)
    {
        $catProduct = new Productcategory();
        $dataCatPro = $catProduct->getCategoryParent();
        if(empty($dataCatPro)){
            $dataCatPro = array();
        }

        $categories = new Categories();
        $dataCatNew = $categories->getCategoryParent();
        if(empty($dataCatNew)){
            $dataCatNew = array();
        }

        $page = new Pages();
        $dataPage = $page->getPageAll();
        if(empty($dataPage)){
            $dataPage = array();
        }

        echo '<option value="">-- Select a ... --</option>';
        switch ($id) {
            case 1:{
                foreach ($dataCatPro as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                break;
            }
            case 2:{
                foreach ($dataCatNew as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
            }
                
            
            default:{
                foreach ($dataPage as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
            }
        }
        
    }
}
