<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quantri\models\CuaHang;
use backend\models\SignupForm;
use backend\modules\auth\models\AuthItem;
use backend\modules\auth\models\AuthAssignment;
use common\models\LoginForm;
use yii\web\Session;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\Json;
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
                    'delete' => ['post'],
                    'delete-multiple' => ['post'],
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


    public function init()
    {
        $module = Yii::$app->getModule('gridview');
        if ($module == null || !$module instanceof \kartik\grid\Module) {
            throw new InvalidConfigException('The "gridview" module MUST be setup in your Yii configuration file and assigned to "\kartik\grid\Module" class.');
        }
        parent:: init();
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;


        // if($user->manager != 1){
        //     throw new NotFoundHttpException('Bạn không có quyền vào đây');
        // }
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post('hasEditable') && Yii::$app->request->post('editableKey')) 
        {
            $editableKey = Yii::$app->request->post('editableKey');
            
            //  else {
            $model = User::findOne($editableKey);
            if ($editableKey==1) {
                $output = 'Đây là admin, không thể sửa';
            } else {
                $editableIndex = Yii::$app->request->post('editableIndex');
                $editableAttribute = Yii::$app->request->post('editableAttribute');
                
                $post = [];
                $posted = current($_POST['User']);
                $post['User'] = $posted;
                if ($model->load($post)  && $model->validate()) 
                {
                    // if ($editableAttribute == 'cuahang_id') {
                    //     $model->$editableAttribute = json_decode($post['User'][$editableKey][$editableAttribute]);
                    // }
                    $model->updated_at=time();
                    $model->user_update=$user->id;
                    $model->save();
                    $output = '';
                }else {
                    $errors = $model->errors;
                    $output = $errors[$editableAttribute][0];
                }
            }
            
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            
            echo $out;
            return;
        }



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

    public function actionResetpassword($id)
    {
        $user_username = User::find()->select('username')->where(['id'=>$id])->one();
        $user_username = $user_username->username;
        if ($id == 1) {
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
    public function actionChangepassword()
    {
        $this->layout ='home';
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
            $user->updated_at = time();

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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $authItems = ['manager'=>'Quản lý','author'=>'Nhập liệu','khachhang'=>'Quản lý khách hàng'];

        $manager = [0 => 'Nhân viên', 1 => 'Quản lý'];

        $user = Yii::$app->user->identity;

        // echo md5($user->username.$user->auth_key);die;
        if($user->manager != 1){
            throw new NotFoundHttpException('Bạn không có quyền Sửa thông tin');
        }
        if($model->id == 1 && getUser()->id != 1){
            throw new NotFoundHttpException('Bạn không có quyền Sửa Admin');
            $manager = [1 => 'Quản lý']; 
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            $dataCuahang = array();
        }
        if($model->cuahang_id != ''){
            $model->cuahang_id = json_decode($model->cuahang_id);
        }
        $model->updated_at = time();

        // validate for normal request
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        $auth = AuthAssignment::findOne(['user_id'=>$model->id]);
        if ($auth) {
            $model->permission = $auth->item_name;
        }

        
        if ($model->load($post = Yii::$app->request->post())) {
            
            if ($post['User']['image'] != '') {
               $model->image = str_replace(Yii::$app->request->hostInfo, '', $post['User']['image']);
            }

            if ($post['User']['permission'] != '' && isset($auth)) {
               $auth->item_name = $post['User']['permission'];
               $auth->created_at = time();
               $auth->save();
            }

            if ($post['User']['cuahang_id'] != '') {
               $model->cuahang_id = json_encode($post['User']['cuahang_id']);
            } else {
                $model->cuahang_id = '';
            }
            
            
            
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'manager' => $manager,
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
        $user = Yii::$app->user->identity;
        if($model->id == 1){
            throw new NotFoundHttpException('Bạn không thể xóa user admin');
        }
        if($user->manager != 1){
            throw new NotFoundHttpException('Bạn không có quyền xóa user User');
        }
        $auth = AuthAssignment::findOne(['user_id'=>$model->id]);
        $model->delete();
        if ($auth) {
            $auth->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionSignup()
    {
        // $this->layout = 'signup';
        $model = new SignupForm();

        $authItems = ['manager'=>'Quản lý','author'=>'Nhập liệu','khachhang'=>'Quản lý khách hàng'];

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

            // echo '<pre>';print_r($authItems);die;

        if ($model->load($post = Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                // if (Yii::$app->getUser()->login($user)) {
                //     return $this->goHome();
                // }

                Yii::$app->session->setFlash('messeage','Bạn đã thêm thành công :'.$user->username);
                return $this->redirect(['index']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
            'authItems' => $authItems,
        ]);
    }

    // public function actionSignup()
    // {
    //     $this->layout = 'signup';
    //     $user = Yii::$app->user->identity;
    //     if($user->id != 1){
    //         throw new NotFoundHttpException('Bạn không có quyền thêm User');
    //     }

    //     $model = new SignupForm();
    //     $authitems = AuthItem::find()->all();

    //     // $authItems = ArrayHelper::map($authitems,'name','description');
    //     $authItems = array(
    //         'admin' => 'Quản trị cấp cao',
    //         'author' => 'Quyền tác giả'
    //     );

        

    //     if ($model->load($post = Yii::$app->request->post())) {
    //      // echo '<pre>';
    //     // print_r($post);die;
    //         if ($user = $model->signup()) {
    //             // if (Yii::$app->getUser()->login($user)) {
    //             //     return $this->goHome();
    //             // }
    //             Yii::$app->session->setFlash('messeage','Bạn đã thêm thành công :'.$user->username);
    //             return $this->redirect(['index']);
    //         }
    //     }

    //     return $this->render('signup', [
    //         'model' => $model,
    //         'authItems' => $authItems,
    //     ]);
    // }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
