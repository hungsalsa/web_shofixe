<?php

namespace backend\modules\auth\controllers;

use Yii;
use common\modules\auth\models\AuthItem;
use common\modules\auth\models\AuthItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RbacController implements the CRUD actions for AuthItem model.
 */
class RbacvdController extends Controller
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

        /*return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule,$action)
                        {
                            $module = Yii::$app->controller->module->id;
                            $action = Yii::$app->controller->action->id;
                            $controller = Yii::$app->controller->id;
                            $route = "$module/$controller/$action";
                            $post = Yii::$app->request->post();
                            if (\Yii::$app->user->can($route)) {
                                return true;
                            }
                        }
                    ],
                    // [
                    //     'allow' => true,
                    //     'actions' => ['logout'],
                    //     'roles' => ['@'],
                    // ],
                ],
            ],
        ];*/
    }

    

    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        $author = $auth->createRole('author');
        $manager = $auth->createRole('manager');
        $admin = $auth->createRole('admin');
         // $auth = new DbManager;
/*
        $quanlytin_videos_index = $auth->createPermission('quanlytin/videos/index');
        $quanlytin_videos_index->description = 'Danh sách User';
        $auth->add($quanlytin_videos_index);

        // $quanlytin_videos_changepassword = $auth->createPermission('quanlytin/videos/changepassword');
        // $quanlytin_videos_changepassword->description = 'Đổi mật khẩu';
        // $auth->add($quanlytin_videos_changepassword);

        /*$quanlytin_videos_signup = $auth->createPermission('quanlytin/videos/create');
        $quanlytin_videos_signup->description = 'Thêm mới Account';
        $auth->add($quanlytin_videos_signup);

        $quanlytin_videos_update = $auth->createPermission('quanlytin/videos/update');
        $quanlytin_videos_update->description = 'Chỉnh sửa Account';
        $auth->add($quanlytin_videos_update);

        $quanlytin_videos_view = $auth->createPermission('quanlytin/videos/view');
        $quanlytin_videos_view->description = 'Chi tiết Account';
        $auth->add($quanlytin_videos_view);

        $quanlytin_videos_delete = $auth->createPermission('quanlytin/videos/delete');
        $quanlytin_videos_delete->description = 'Xóa Account';
        $auth->add($quanlytin_videos_delete);


        $auth->addChild($author, $quanlytin_videos_index);
        // $auth->addChild($author, $quanlytin_videos_changepassword);
        $auth->addChild($author, $quanlytin_videos_signup);
        $auth->addChild($author, $quanlytin_videos_view);
        $auth->addChild($author, $quanlytin_videos_delete);
        $auth->addChild($author, $quanlytin_videos_update);*/
        $quanlytin_videos_quickchange = $auth->createPermission('quanlytin/videos/quickchange');
        $quanlytin_videos_quickchange->description = 'Sửa nhanh Video';
        $auth->add($quanlytin_videos_quickchange);

        $auth->addChild($author, $quanlytin_videos_quickchange);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
