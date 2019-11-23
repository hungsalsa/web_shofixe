<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\SignupForm;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use backend\modules\auth\models\AuthAssignment;
use yii\web\HttpException;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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

                            $role = $control.'/'.$action;
                            // $db_name = $user->db_name;
                            if (Yii::$app->user->can($role)) {
                                return true;
                            }else {
                              throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây, chưa được chia sẻ quyền');
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    // 'delete' => ['post'],
                    // 'delete-multiple' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionSignup()
    {
        // $this->layout = 'signup';
        $model = new SignupForm();
        $user = new User();

        $authItems = ['manager'=>'Biên tập viên','author'=>'Cộng tác viên'];

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

            // echo '<pre>';print_r($authItems);die;

        if ($model->load($post = Yii::$app->request->post())) {
            // dbg($_POST['SignupForm']['permission']);
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('messeage','Bạn đã thêm thành công :'.$user->username);
                return $this->redirect(['index']);
            }
        }
        return $this->render('signup', [
            'model' => $model,
            'user' => $user,
            'authItems' => $authItems,
        ]);
    }
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['!=', 'username', 'hungsalsa']);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionResetpassword($id)
    {
        $user_username = User::find()->select('username')->where(['id'=>$id])->one();
        $user_username = $user_username->username;
        if ($id == 1 || $id==3) {
            throw new HttpException(403,'Bạn không thể sửa mật khẩu tài khoản quản trị');
        }
        if ($id == Yii::$app->user->identity->id) {
            throw new HttpException(403,'Bạn hãy thay đổi mật khẩu tài khoản của mình chứ ko Reset');
        }
        if (Yii::$app->user->identity->id != 1 && Yii::$app->user->identity->id != 2 && Yii::$app->user->identity->id != 9) {
            throw new HttpException(403,'Bạn không có quyền truy cập ');
        }
        $model = new \backend\models\ResetPasswordForm();
        if ($model->load($post = Yii::$app->request->post()) && $model->validate()) {
            // dbg($post);
            $username = $model->resetPassword($id,$post['ResetPasswordForm']['password']);

            Yii::$app->session->setFlash('messeage','Bạn đã Reset mật khẩu thành công tài khoản : '.$username);
            return $this->redirect(['index']);
        }
        return $this->render('resetPassword', [
            'model' => $model,
            'user_username' => $user_username,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $permission = new AuthAssignment();
        if ($permission->PermissionUser($id)) {
            $model->permission = $permission->PermissionUser($id);
            
        }
        if ($id==3) {
            throw new HttpException(403,'Bạn không thể sửa mật khẩu tài khoản quản trị');
        }

        $authItems = ['admin'=>'Admin','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];

        if ($model->load($post = Yii::$app->request->post())) {
            $permission = AuthAssignment::findOne(['user_id'=>$id]);
            if ($permission) {
                $permission->item_name= $post['User']['permission'];
                $permission->updated_at= time();
            }else {
                $permission = new AuthAssignment();
                $permission->user_id= $id;
                $permission->item_name= $post['User']['permission'];
                $permission->created_at= time();
                $permission->updated_at= time();
            }
            // dbg($post);
            if($model->save() && $permission->save()) pr('sada');
                // dbg($permission->errors);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'authItems' => $authItems,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($id==1) {
            throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
        }
        $permission = AuthAssignment::findOne(['user_id'=>$id]);
        $model->delete();
        if ($permission) {
            $permission->delete();
            
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionChangepassword()
    {
        // set up user and load post data
        $user = Yii::$app->user->identity;
        $user->scenario = 'changepassword';
        $loadedPost = $user->load(Yii::$app->request->post());
        
        // echo "<pre>";print_r($user);die;

        // validate for normal request
        if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($user);
        }
        if ($loadedPost && $user->validate()) {

            $user->password = $user->newPassword;

            // save , set flash, and refresh page
            // echo '<pre>'; print_r($user);die
            if($user->save()){
                Yii::$app->session->setFlash('messeage','You have successfully change your password');
                Yii::$app->user->logout();

                return $this->goHome();
            }
            // $session = Yii::$app->session;
            // unset($session['old_id']);
            // unset($session['timestamp']);
            // $session->destroy();
            return $this->refresh();
        }

        // render
        return $this->render("change_password",[
            'user'=>$user,
        ]);
        
    }
    
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
