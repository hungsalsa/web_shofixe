<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
// namespace app\components;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $layout = 'home';
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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
            Yii::$app->session->setFlash('messeage','Chào mừng bạn tới với admin');
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }



        if (!\Yii::$app->user->isGuest) {
        return $this->goHome();
    }

// $model = new LoginForm();
// if ($model->load(Yii::$app->request->post()) && $model->login()) {
// //check user roles, is user is Admin? 
//     if (\Yii::$app->user->can('Admin'))
//     {
//         // yes he is Admin, so redirect page 
//         // return $this->goBack();
//          return $this->redirect(['quantri/productcategory']);
//     }
//     else // if he is not an Admin then what :P
//     {   // put him out :P Automatically logout. 
//         Yii::$app->user->logout();
//         // set error on login page. 
//         \Yii::$app->getSession()->setFlash('error', 'You are not authorized to login Admin\'s penal.<br /> Please use valid Username & Password.<br />Please contact Administrator for details.');
//         //redirect again page to login form.
//         return $this->redirect(['site/login']);
//     }

// } else {
// return $this->render('login', [
//     'model' => $model,
// ]);
// }


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
}
