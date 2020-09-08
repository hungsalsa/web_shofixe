<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\modules\chi\models\Employee;
use backend\modules\chi\models\Chingay;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
use backend\models\SignupForm;
use backend\modules\auth\models\AuthItem;
use backend\modules\quantri\models\CuaHang;
use backend\models\User;
use backend\models\Thongke;
use yii\web\HttpException;
// namespace app\components;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];


        // return [
        //     'access' => [
        //         'class' => AccessControl::className(),
        //         'rules' => [
        //             [
        //                 'actions' => ['login', 'error'],
        //                 'allow' => true,
        //             ],
        //             [
        //                 'actions' => ['logout', 'index'],
        //                 'allow' => true,
        //                 'roles' => ['@'],
        //                 'matchCallback'=> function ($rule ,$action)
        //                 {
        //                     $control = Yii::$app->controller->id;
        //                     $action = Yii::$app->controller->action->id;
        //                     // $module = Yii::$app->controller->module->id;

        //                     $role = $control.'/'.$action;
        //                     if (Yii::$app->user->can($role)) {
        //                         return true;
        //                     }
        //                 }
        //             ],
        //         ],
        //     ],
        //     'verbs' => [
        //         'class' => VerbFilter::className(),
        //         'actions' => [
        //             'logout' => ['post'],
        //             'delete' => ['post'],
        //         ],
        //     ],
        // ];

    }

    /**
     * {@inheritdoc}
     */
    public function actionError()
    {
            $error = Yii::app()->errorHandler->error;
            switch($error['code'])
            {
                case 403:

                $this->render('error403', array('error' => $error));
                break;
                default:
                $this->render('error404', array('error' => $error));
                break;
            }
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error404'
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function beforeAction($action)
 {
    $this->layout = 'home'; //your layout name
    return parent::beforeAction($action);
 }
    public function actionIndex()
    {

        $product = new Product();
        $cate = new ProductCate();
        $cuahang = new CuaHang();
        $cuahangs = $cuahang->getAllCuahang();

        $imageUser = User::find()->select(['image','id'])->where(['<>','image',''])->asArray()->indexBy('id')->column();
        
        if(getUser()->manager != 1){
            $list = json_decode(getUser()->cuahang_id);
            foreach ($cuahangs as $key => $value) {
                if(!in_array($key, $list)){
                    unset($cuahangs[$key]);
                }
            }
            // $cuahangs = json_decode($user->cuahang_id);
        }
        
        $thongk = new Thongke();
        $dataCount = $thongk->getCount();


        $data = [
            'category'=>$cate->getAllCate(),
            'cuahangs'=>$cuahangs,
        ];
        return $this->render('index',['data'=>$data,'dataCount'=>$dataCount,'imageUser'=>$imageUser]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user_login = Yii::$app->user->identity->fullname;
            // if (!in_array($user_login->id,[1,2])) {
            //     throw new HttpException(403, 'Bạn không có quyền vào đây, chưa chia sẻ quyền');
            // }
            Yii::$app->session->setFlash('messeage','Chào mừng '.$user_login.' tới với quản trị Mototech');
            return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
            // return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $this->layout = 'signup';
        $model = new SignupForm();
        $authitems = AuthItem::find()->all();

        // $authItems = ArrayHelper::map($authitems,'name','description');
        $authItems = array(
            'admin' => 'Quản trị cấp cao',
            'author' => 'Quyền tác giả'
        );

         // echo '<pre>';
        // print_r($authItems);die;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                // if (Yii::$app->getUser()->login($user)) {
                //     return $this->goHome();
                // }
                Yii::$app->session->setFlash('messeage','Bạn đã thêm thành công :'.$user->username);
                return $this->redirect(['/user']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
            'authItems' => $authItems,
        ]);
    }

    public function actionRegister()
    {
        $model = new User();

        if ($model->load($post = Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->username = $post['User']['username'];
                $model->email = $post['User']['email'];
                $model->fullname = $post['User']['fullname'];
                $model->password_hash = password_hash($post['User']['email'], PASSWORD_ARGON2I);
                $model->auth_key = md5(random_bytes(5));
                $model->accessToken = password_hash(random_bytes(10), PASSWORD_DEFAULT);
                if($model->save()){
                    return;
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
