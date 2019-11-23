<?php

namespace backend\modules\quanlytin\controllers;

use Yii;
use backend\modules\quanlytin\models\Videos;
use backend\modules\quanlytin\models\VideosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use backend\modules\quanlytin\models\Categories;
use yii\filters\AccessControl;
use  backend\modules\auth\models\AuthAssignment;
/**
 * VideosController implements the CRUD actions for Videos model.
 */
class VideosController extends Controller
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
     * Lists all Videos models.
     * @return mixed
     */
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }
    public function actionIndex()
    {
        $searchModel = new VideosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'sort' => SORT_ASC,'created_at' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionQuickchange()
    {
        $post = Yii::$app->request->post();
        $id = $post['id'];
        $model = Videos::findOne($id);


        if (Yii::$app->user->identity->getRoleName()=='author' && $model->user_add != getUser()->id) {
            return json_encode(["postValue" => "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin"]);
        }

        $authAssis = new AuthAssignment();
        // Lấy quyền của usẻ đăng nhập
        $perrmission = $authAssis->PermissionUser($model->user_add);
        $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        if ($perrmission_login !='admin' && $model->user_add != getUser()->id ) {
            $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            $return =  "Bài này do $result[$perrmission] : ".$model->userAdd->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn";
            return json_encode(["postValue" => $return]);
        }

        $field = $post['field'];
        $value_post = $post['value_post'];
        $model->$field = $value_post;
        $result = [
            'id' => $id,
            'value_post' => $value_post,
            'name' => $model->name,
            'field' => $post['field'],
        ];

        $result = array_merge($result,["postValue" => $value_post]);

        $model->updated_at = time();
        $model->user_add = getUser()->id;

        if($model->save()==true) {
            return json_encode($result);
        }else {
            $erros = $model->errors;
            $result = array_merge($result,["error" => $erros]);
            return json_encode($result);
        }

    }

    /**
     * Displays a single Videos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = '@backend/views/layouts/main_jquery';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Videos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Videos();

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $cate = new Categories();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = [];
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            $link = $post['Videos']['link'];
            if ($vitri = strpos($link, '&list')) {
                $link = substr($link,0,$vitri);
            }
            if($post['Videos']['sort'] ==''){
                $model->sort = 999;
            }

            $model->link = str_replace("watch?v=", "embed/", $post['Videos']['link']);

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
     * Updates an existing Videos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->user->identity->getRoleName()=='author' && $model->user_add != getUser()->id) {
            throw new \yii\web\HttpException(403, "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin");
        }

        $authAssis = new AuthAssignment();
        // Lấy quyền của usẻ đăng nhập
        $perrmission = $authAssis->PermissionUser($model->user_add);
        $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        if ($perrmission_login !='admin' && $model->user_add != getUser()->id ) {
            $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            throw new \yii\web\HttpException(403, "Bài này do $result[$perrmission] : ".$model->userAdd->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn");
        }


        $model->updated_at = time();
        $model->user_edit = Yii::$app->user->id;

        $cate = new Categories();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = [];
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            $link = $post['Videos']['link'];
            if ($vitri = strpos($link, '&list')) {
                $link = substr($link,0,$vitri);
            }
            if($post['Videos']['sort'] ==''){
                $model->sort = 999;
            }
            $model->link = str_replace("watch?v=", "embed/", $link);

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
     * Deletes an existing Videos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->user->identity->getRoleName()=='author' && $model->user_add != getUser()->id) {
            throw new \yii\web\HttpException(403, "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin");
        }

        $authAssis = new AuthAssignment();
        // Lấy quyền của usẻ đăng nhập
        $perrmission = $authAssis->PermissionUser($model->user_add);
        $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        if ($perrmission_login !='admin' && $model->user_add != getUser()->id ) {
            $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            throw new \yii\web\HttpException(403, "Bài này do $result[$perrmission] : ".$model->userAdd->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn");
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Videos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Videos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Videos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
