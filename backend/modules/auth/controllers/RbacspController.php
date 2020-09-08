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
class RbacspController extends Controller
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

        // $rule = new \app\rbac\UserGroupRule;
        // $auth->add($rule);

        
        // $sanpham_nhanban_suama = $auth->createPermission('sanpham/nhanban/suama');
        // $sanpham_nhanban_suama->description = 'Sửa mã sản phẩm và dịch vụ';
        // $auth->add($sanpham_nhanban_suama);

        // $sanpham_product_edit = $auth->createPermission('sanpham/product/edit');
        // $sanpham_product_edit->description = 'Sửa mã sản phẩm trực tiếp từ danh sách';
        // $auth->add($sanpham_product_edit);

        $sanpham_product_quickchange = $auth->createPermission('sanpham/product/quickchange');
        $sanpham_product_quickchange->description = 'Sửa mã nhanh trực tiếp từ danh sách sản phẩm';
        // $auth->add($sanpham_product_quickchange);

        $sanpham_suanhanh = $auth->createPermission('sanpham/product/suanhanh');
        $sanpham_suanhanh->description = 'Sửa nhanh sản phẩm nhân ra cửa hàng khác';
        // $auth->add($sanpham_suanhanh);

        $sanpham_updateproduct = $auth->createPermission('sanpham/product/updateproduct');
        $sanpham_updateproduct->description = 'Cập nhật sản phẩm từ 173 Tam Trinh ra cửa hàng khác';
        // $auth->add($sanpham_updateproduct);

        $sanpham_chuyenkho_kiemtrachuyen = $auth->createPermission('sanpham/chuyenkho/kiemtrachuyen');
        $sanpham_chuyenkho_kiemtrachuyen->description = 'Kiểm tra số lượng tồn kho và vị trí phụ tùng xuất đi';
        // $auth->add($sanpham_chuyenkho_kiemtrachuyen);
/*
        $sanpham_location_index = $auth->createPermission('sanpham/location/index');
        $sanpham_location_index->description = 'Danh sách vị trí kho';
        $auth->add($sanpham_location_index);

        $sanpham_location_create = $auth->createPermission('sanpham/location/create');
        $sanpham_location_create->description = 'Thêm mới vị trí kho';
        $auth->add($sanpham_location_create);

        $sanpham_location_view = $auth->createPermission('sanpham/location/view');
        $sanpham_location_view->description = 'Chi tiết vị trí kho';
        $auth->add($sanpham_location_view);

        $sanpham_location_update = $auth->createPermission('sanpham/location/update');
        $sanpham_location_update->description = 'Chỉnh sửa vị trí kho';
        $auth->add($sanpham_location_update);

        $sanpham_location_delete = $auth->createPermission('sanpham/location/delete');
        $sanpham_location_delete->description = 'Xóa vị trí kho';
        $auth->add($sanpham_location_delete);
*/
        // $auth->addChild($manager, $sanpham_nhanban_suama);
        // $auth->addChild($author, $sanpham_product_edit);
        $auth->addChild($author, $sanpham_product_quickchange);
        $auth->addChild($manager, $sanpham_suanhanh);
        $auth->addChild($manager, $sanpham_updateproduct);
        $auth->addChild($author, $sanpham_chuyenkho_kiemtrachuyen);
        // $auth->addChild($author, $sanpham_location_index);
        // $auth->addChild($author, $sanpham_location_create);
        // $auth->addChild($author, $sanpham_location_view);
        // $auth->addChild($author, $sanpham_location_update);
        // $auth->addChild($manager, $sanpham_location_delete);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
