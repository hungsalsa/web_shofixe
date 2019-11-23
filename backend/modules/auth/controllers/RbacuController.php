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
class RbacuController extends Controller
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

        /*$user_index = $auth->createPermission('user/index');
        $user_index->description = 'Danh sách User';
        // $auth->add($user_index);

        $user_changepassword = $auth->createPermission('user/changepassword');
        $user_changepassword->description = 'Đổi mật khẩu';
        // $auth->add($user_changepassword);

        $user_signup = $auth->createPermission('user/signup');
        $user_signup->description = 'Thêm mới Account';
        // $auth->add($user_signup);

        $user_update = $auth->createPermission('user/update');
        $user_update->description = 'Chỉnh sửa Account';
        // $auth->add($user_update);

        $user_view = $auth->createPermission('user/view');
        $user_view->description = 'Chi tiết Account';
        $auth->add($user_view);

        $user_delete = $auth->createPermission('user/delete');
        $user_delete->description = 'Xóa Account';
        $auth->add($user_delete);
        */
        $resetpassword = $auth->createPermission('user/resetpassword');
        $resetpassword->description = 'Resetpassword Account';
        $auth->add($resetpassword);


        $auth->addChild($author, $resetpassword);
        // $auth->addChild($manager, $user_index);
        // $auth->addChild($author, $user_changepassword);
        // $auth->addChild($admin, $user_signup);
        // $auth->addChild($manager, $user_view);
        // $auth->addChild($admin, $user_delete);
        // $auth->addChild($admin, $user_update);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
