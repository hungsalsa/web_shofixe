<?php

namespace backend\modules\quanlytin\controllers;

use Yii;
use backend\modules\quanlytin\models\Categories;
use backend\modules\quanlytin\models\CategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm; //Add This Line
use yii\filters\AccessControl;
use yii\web\HttpException;
/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
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
     * Lists all Categories models.
     * @return mixed
     */
    public function beforeAction($action) 
{ 
    $this->enableCsrfValidation = false; 
    return parent::beforeAction($action); 
}
    public function actionIndex()
    {
        $searchModel = new CategoriesSearch();
        $params = Yii::$app->request->queryParams;
        // if ($params['CategoriesSearch']==0) {
        //     $params['CategoriesSearch']['status']=1;            
        // } 
        $dataProvider = $searchModel->search($params);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatestatus($id){
        
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

//     public function actionChangeStatus($id, $currentStatus, $field = 'status') {
//     // public function actionChangestatus() {

//         $slug =Yii::$app->request->url;
//         // $this->layout = false;
//         // $this->autoRender = false;
//         // $model = $this->modelClass;


//         // $checkExisted = $this->$model->find('count', array(
//         //     'conditions' => array(
//         //         'id' => $id
//         //     ),
//         //     'recursive' => -1,
//         // ));

// // echo '<pre>';print_r($slug);die;
//         $checkExisted = $this->findModel($id);


//         if (!$checkExisted) {
//             return json_encode(array(
//                 'success' => false
//             ));
//         }
//         $newStatus = ($currentStatus+1)%2;
//         // $this->$model->create();
//         // $checkExisted->id = $id;
//         $checkExisted->$field = $newStatus;
//         // $checkExisted->id = $id;
//         if ($checkExisted->save()) {
//             // if ($model == 'Post') {
//             //     $this->$model->create();
//             //     $this->$model->id = $id;
//             //     $this->$model->saveField('comment', null);
//             // }
//             Cache::clear();
//             return json_encode(array(
//                 'success' => true,
//                 'text' => $newStatus?'Kích hoạt':'Tắt',
//                 'newStatus' => $newStatus
//             ));
//         }
//         return json_encode(array(
//             'success' => false
//         ));

//     }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->userAdd = getUser()->id;

        $dataCate = $model->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = [];
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            // if (isset($post['Categories']['images']) && $post['Categories']['images']!='') {
            //     $model->image = str_replace(Yii::$app->request->hostInfo.'/','',$post['Categories']['images']);
            // }
            if ($post['Categories']['sort'] =='') {
                $model->sort = 1;
            }
            if ($post['Categories']['parent_id'] =='') {
                $model->parent_id = 0;
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataCate' => $dataCate,
        ]);
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at = time();
        $model->user_edit = getUser()->id;

        $dataCate = $model->getCategoryParent();
        unset($dataCate[$id]);
        if(empty($dataCate)){
            $dataCate = [];
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            // if (isset($post['Categories']['images']) && $post['Categories']['images']!='') {
            //     $model->image = str_replace(Yii::$app->request->hostInfo.'/','',$post['Categories']['images']);
            // }
            
            if ($post['Categories']['sort'] =='') {
                $model->sort = 1;
            }
            if ($post['Categories']['parent_id'] =='') {
                $model->parent_id = 0;
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataCate' => $dataCate,
        ]);
    }

    /**
     * Deletes an existing Categories model.
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
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
