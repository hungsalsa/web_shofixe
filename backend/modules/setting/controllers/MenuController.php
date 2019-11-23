<?php

namespace backend\modules\setting\controllers;

use Yii;
use backend\modules\setting\models\Menus;
use backend\modules\setting\models\MenusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quanlytin\models\Categories;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
/**
 * MenuController implements the CRUD actions for Menus model.
 */
class MenuController extends Controller
{
    /**
     * @inheritdoc
     */
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
                        'matchCallback'=> function ($rule ,$action)
                        {
                            $control = Yii::$app->controller->id;
                            $action = Yii::$app->controller->action->id;
                            $module = Yii::$app->controller->module->id;

                            $role = $module.'/'.$control.'/'.$action;
                            if (Yii::$app->user->can($role)) {
                                return true;
                            }else {
                                throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    // 'laygia' => ['post'],
                    // 'subcat' => ['post'],
                    // 'delete' => ['post'],
                    // 'suachitiet' => ['post'],
                    // 'xoachitiet' => ['post'],
                    // 'checkvitri' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
        
        $categories = new Categories();
        $dataLinkCat = $categories->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        $model->status = true;
        $model->type = 1;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post()) ) {
            if ($post['Menus']['parent_id'] == '') {
                $model->parent_id = 0;
            }
            if($post['Menus']['order'] ==''){
                $model->order = 1;
            }

            if ($post['Menus']['link_cate'] !='') {
                $slugcate = Categories::find('slug')->select(['slug'])->where(['id'=>$post['Menus']['link_cate']])->one();
                $model->slug = $slugcate->slug;
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


        $dataMenus = $model->getMenuParent();
        
        $dataLinkCat = array();

        $categories = new Categories();
        $dataLinkCat = $categories->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }
 
        $model->type = 1;
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post()) ) {
            if ($post['Menus']['parent_id'] =='') {
                $model->parent_id = 0;
            }
            if($post['Menus']['order'] ==''){
                $model->order = 1;
            }

            if ($post['Menus']['link_cate'] !='') {
                $slugcate = Categories::find('slug')->select(['slug'])->where(['id'=>$post['Menus']['link_cate']])->one();
                $model->slug = $slugcate->slug;
            }
// pr($model->errors);
            if($model->save()){
                return $this->redirect(['index']);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'dataMenus' => $dataMenus,
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
}
