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
class RbactkController extends Controller
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

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    // User assigment
    public function actionAssigment()
    {
        $auth = Yii::$app->authManager;
        
        $author = $auth->createRole('author');
        $admin = $auth->createRole('admin');


         // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }

    // Create Role 
    public function actionCreate_role()
    {
        $auth = Yii::$app->authManager;
        // Author ->index/create/view
        // Admin ->{Author} and update/delete ->index/create/view

        // $categories_index = $auth->createPermission('quantri/categories/index');
        // $categories_create = $auth->createPermission('quantri/categories/create');
        // $categories_view = $auth->createPermission('quantri/categories/view');

        // $categories_update = $auth->createPermission('quantri/categories/update');
        // $categories_delete = $auth->createPermission('quantri/categories/delete');

        // $tksanpham = $auth->createPermission('common/tksanpham/index');
        $capnhatton = $auth->createPermission('common/sanpham-thongke/capnhatton');


        $author = $auth->createRole('author');
        // $auth->add($author);
        // $auth->addChild($author, $categories_index);
        // $auth->addChild($author, $categories_create);
        // $auth->addChild($author, $categories_view);

        // $auth->addChild($author, $tksanpham);
        $auth->addChild($author, $capnhatton);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        // $admin = $auth->createRole('admin');
        // $auth->add($admin);
        // $auth->addChild($admin, $author);
        // $auth->addChild($admin, $categories_update);
        // $auth->addChild($admin, $categories_delete);
    }
    // Create Permission 
    public function actionCreate_permission()
    {
         $auth = Yii::$app->authManager;
         // $auth = new DbManager;

        
        // $manager = $auth->createRole('manager');
        // $auth->add($author);

        // add "quantri/categories/index" permission
        $capnhatton = $auth->createPermission('common/sanpham-thongke/capnhatton');
        $capnhatton->description = 'Thống kê sản phẩm để in';
        $auth->add($capnhatton);
        
        // $tksanpham = $auth->createPermission('common/tksanpham/index');
        // $tksanpham->description = 'Thống kê sản phẩm để in';
        // $auth->add($tksanpham);

        // $sanpham_nhanban_index = $auth->createPermission('sanpham/nhanban/index');
        // $sanpham_nhanban_index->description = 'Nhân bản sản phẩm ra cửa hàng khác';
        // $auth->add($sanpham_nhanban_index);

        // $auth->addChild($manager, $sanpham_nhanban_index);

// // add "quantri/categories/create" permission
//         $categories_create = $auth->createPermission('quantri/categories/create');
//         $categories_create->description = 'quantri/categories/create';
//         $auth->add($categories_create);
// // add "quantri/categories/update" permission
//         $categories_update = $auth->createPermission('quantri/categories/update');
//         $categories_update->description = 'quantri/categories/update';
//         $auth->add($categories_update);
// // add "quantri/categories/view" permission
//         $categories_view = $auth->createPermission('quantri/categories/view');
//         $categories_view->description = 'quantri/categories/view';
//         $auth->add($categories_view);
// // add "quantri/categories/delete" permission
//         $categories_delete = $auth->createPermission('quantri/categories/delete');
//         $categories_delete->description = 'quantri/categories/delete';
//         $auth->add($categories_delete);

        // add "updatePost" permission
        // $updatePost = $auth->createPermission('updatePost');
        // $updatePost->description = 'Update post';
        // $auth->add($updatePost);

        // add "author" role and give this role the "createPost" permission
        // $author = $auth->createRole('author');
        // $auth->add($author);
        // $auth->addChild($author, $group_delete);

        // // add "admin" role and give this role the "updatePost" permission
        // // as well as the permissions of the "author" role
        // $admin = $auth->createRole('admin');
        // $auth->add($admin);
        // $auth->addChild($admin, $updatePost);
        // $auth->addChild($admin, $group_delete);

        // // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // // usually implemented in your User model.
        // $auth->assign($author, 2);
        // $auth->assign($admin, 1);
    }

    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        
        $manager = $auth->createRole('manager');
        $author = $auth->createRole('author');
        $admin = $auth->createRole('admin');

        // $rule = new \app\rbac\UserGroupRule;
        // $auth->add($rule);

        
        $sanpham_thongke = $auth->createPermission('common/sanpham-thongke/index');
        $sanpham_thongke->description = 'Bảng cập nhập phụ tùng tồn kho';
        // $sanpham_thongke->ruleName = $rule->name;
        $auth->add($sanpham_thongke);

        $auth->addChild($admin, $sanpham_thongke);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
