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
class RbacqtController extends Controller
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
         // $auth = new DbManager;

        // Don vi tinh
        $quantri_unit_index = $auth->createPermission('quantri/unit/index');
        $quantri_unit_index->description = 'Danh sách đơn vị tính';
        $auth->add($quantri_unit_index);

        // add "quantri/unit/create" permission
        $quantri_unit_create = $auth->createPermission('quantri/unit/create');
        $quantri_unit_create->description = 'Thên mới đơn vị tính';
        $auth->add($quantri_unit_create);
        // add "quantri/unit/update" permission
        $quantri_unit_update = $auth->createPermission('quantri/unit/update');
        $quantri_unit_update->description = 'Chỉnh sửa đơn vị tính';
        $auth->add($quantri_unit_update);
        // add "quantri/unit/view" permission
        $quantri_unit_view = $auth->createPermission('quantri/unit/view');
        $quantri_unit_view->description = 'Chi tiết đơn vị tính';
        $auth->add($quantri_unit_view);
        // add "quantri/unit/delete" permission
        $quantri_unit_delete = $auth->createPermission('quantri/unit/delete');
        $quantri_unit_delete->description = 'Xóa đơn vị tính';
        $auth->add($quantri_unit_delete);

        $manager = $auth->createRole('manager');
        $author = $auth->createRole('author');
        $auth->addChild($author, $quantri_unit_index);
        $auth->addChild($manager, $quantri_unit_create);
        $auth->addChild($manager, $quantri_unit_update);
        $auth->addChild($author, $quantri_unit_view);
        $auth->addChild($manager, $quantri_unit_delete);


        // Hãng xe
        $quantri_hangxe_index = $auth->createPermission('quantri/hangxe/index');
        $quantri_hangxe_index->description = 'Danh sách Hãng xe';
        $auth->add($quantri_hangxe_index);

        // add "quantri/hangxe/create" permission
        $quantri_hangxe_create = $auth->createPermission('quantri/hangxe/create');
        $quantri_hangxe_create->description = 'Thên mới Hãng xe';
        $auth->add($quantri_hangxe_create);
        // add "quantri/hangxe/update" permission
        $quantri_hangxe_update = $auth->createPermission('quantri/hangxe/update');
        $quantri_hangxe_update->description = 'Chỉnh sửa Hãng xe';
        $auth->add($quantri_hangxe_update);
        // add "quantri/hangxe/view" permission
        $quantri_hangxe_view = $auth->createPermission('quantri/hangxe/view');
        $quantri_hangxe_view->description = 'Chi tiết Hãng xe';
        $auth->add($quantri_hangxe_view);
        // add "quantri/hangxe/delete" permission
        $quantri_hangxe_delete = $auth->createPermission('quantri/hangxe/delete');
        $quantri_hangxe_delete->description = 'Xóa Hãng xe';
        $auth->add($quantri_hangxe_delete);

        $auth->addChild($author, $quantri_hangxe_index);
        $auth->addChild($manager, $quantri_hangxe_create);
        $auth->addChild($manager, $quantri_hangxe_update);
        $auth->addChild($author, $quantri_hangxe_view);
        $auth->addChild($manager, $quantri_hangxe_delete);

        // danh sách xe
        $quantri_motorbike_index = $auth->createPermission('quantri/motorbike/index');
        $quantri_motorbike_index->description = 'Danh sách xe máy';
        $auth->add($quantri_motorbike_index);

        // add "quantri/motorbike/create" permission
        $quantri_motorbike_create = $auth->createPermission('quantri/motorbike/create');
        $quantri_motorbike_create->description = 'Thên mới xe máy';
        $auth->add($quantri_motorbike_create);
        // add "quantri/motorbike/update" permission
        $quantri_motorbike_update = $auth->createPermission('quantri/motorbike/update');
        $quantri_motorbike_update->description = 'Chỉnh sửa xe máy';
        $auth->add($quantri_motorbike_update);
        // add "quantri/motorbike/view" permission
        $quantri_motorbike_view = $auth->createPermission('quantri/motorbike/view');
        $quantri_motorbike_view->description = 'Chi tiết xe máy';
        $auth->add($quantri_motorbike_view);
        // add "quantri/motorbike/delete" permission
        $quantri_motorbike_delete = $auth->createPermission('quantri/motorbike/delete');
        $quantri_motorbike_delete->description = 'Xóa xe máy';
        $auth->add($quantri_motorbike_delete);

        $auth->addChild($author, $quantri_motorbike_index);
        $auth->addChild($manager, $quantri_motorbike_create);
        $auth->addChild($manager, $quantri_motorbike_update);
        $auth->addChild($author, $quantri_motorbike_view);
        $auth->addChild($manager, $quantri_motorbike_delete);


        // nhân viên
        $quantri_employee_index = $auth->createPermission('quantri/employee/index');
        $quantri_employee_index->description = 'Danh sách nhân viên';
        $auth->add($quantri_employee_index);

        // add "quantri/employee/create" permission
        $quantri_employee_create = $auth->createPermission('quantri/employee/create');
        $quantri_employee_create->description = 'Thên mới nhân viên';
        $auth->add($quantri_employee_create);
        // add "quantri/employee/update" permission
        $quantri_employee_update = $auth->createPermission('quantri/employee/update');
        $quantri_employee_update->description = 'Chỉnh sửa nhân viên';
        $auth->add($quantri_employee_update);
        // add "quantri/employee/view" permission
        $quantri_employee_view = $auth->createPermission('quantri/employee/view');
        $quantri_employee_view->description = 'Chi tiết nhân viên';
        $auth->add($quantri_employee_view);
        // add "quantri/employee/delete" permission
        $quantri_employee_delete = $auth->createPermission('quantri/employee/delete');
        $quantri_employee_delete->description = 'Xóa nhân viên';
        $auth->add($quantri_employee_delete);

        $auth->addChild($author, $quantri_employee_index);
        $auth->addChild($manager, $quantri_employee_create);
        $auth->addChild($manager, $quantri_employee_update);
        $auth->addChild($author, $quantri_employee_view);
        $auth->addChild($manager, $quantri_employee_delete);


        // nhân viên cửa hàng
        $quantri_nhanvienlamviec_index = $auth->createPermission('quantri/nhanvienlamviec/index');
        $quantri_nhanvienlamviec_index->description = 'Danh sách nhân viên cửa hàng';
        $auth->add($quantri_nhanvienlamviec_index);

        // add "quantri/nhanvienlamviec/create" permission
        $quantri_nhanvienlamviec_create = $auth->createPermission('quantri/nhanvienlamviec/create');
        $quantri_nhanvienlamviec_create->description = 'Thên mới nhân viên cửa hàng';
        $auth->add($quantri_nhanvienlamviec_create);
        // add "quantri/nhanvienlamviec/update" permission
        $quantri_nhanvienlamviec_update = $auth->createPermission('quantri/nhanvienlamviec/update');
        $quantri_nhanvienlamviec_update->description = 'Chỉnh sửa nhân viên cửa hàng';
        $auth->add($quantri_nhanvienlamviec_update);
        // add "quantri/nhanvienlamviec/view" permission
        $quantri_nhanvienlamviec_view = $auth->createPermission('quantri/nhanvienlamviec/view');
        $quantri_nhanvienlamviec_view->description = 'Chi tiết nhân viên cửa hàng';
        $auth->add($quantri_nhanvienlamviec_view);
        // add "quantri/nhanvienlamviec/delete" permission
        $quantri_nhanvienlamviec_delete = $auth->createPermission('quantri/nhanvienlamviec/delete');
        $quantri_nhanvienlamviec_delete->description = 'Xóa nhân viên cửa hàng';
        $auth->add($quantri_nhanvienlamviec_delete);

        $auth->addChild($author, $quantri_nhanvienlamviec_index);
        $auth->addChild($manager, $quantri_nhanvienlamviec_create);
        $auth->addChild($manager, $quantri_nhanvienlamviec_update);
        $auth->addChild($author, $quantri_nhanvienlamviec_view);
        $auth->addChild($manager, $quantri_nhanvienlamviec_delete);


        // nhà cung cấp
        $quantri_supplier_index = $auth->createPermission('quantri/supplier/index');
        $quantri_supplier_index->description = 'Danh sách nhà cung cấp';
        $auth->add($quantri_supplier_index);

        // add "quantri/supplier/create" permission
        $quantri_supplier_create = $auth->createPermission('quantri/supplier/create');
        $quantri_supplier_create->description = 'Thên mới nhà cung cấp';
        $auth->add($quantri_supplier_create);
        // add "quantri/supplier/update" permission
        $quantri_supplier_update = $auth->createPermission('quantri/supplier/update');
        $quantri_supplier_update->description = 'Chỉnh sửa nhà cung cấp';
        $auth->add($quantri_supplier_update);
        // add "quantri/supplier/view" permission
        $quantri_supplier_view = $auth->createPermission('quantri/supplier/view');
        $quantri_supplier_view->description = 'Chi tiết nhà cung cấp';
        $auth->add($quantri_supplier_view);
        // add "quantri/supplier/delete" permission
        $quantri_supplier_delete = $auth->createPermission('quantri/supplier/delete');
        $quantri_supplier_delete->description = 'Xóa nhà cung cấp';
        $auth->add($quantri_supplier_delete);

        $auth->addChild($author, $quantri_supplier_index);
        $auth->addChild($manager, $quantri_supplier_create);
        $auth->addChild($manager, $quantri_supplier_update);
        $auth->addChild($author, $quantri_supplier_view);
        $auth->addChild($manager, $quantri_supplier_delete);


        // cửa hàng
        $quantri_cuahang_index = $auth->createPermission('quantri/cuahang/index');
        $quantri_cuahang_index->description = 'Danh sách cửa hàng';
        $auth->add($quantri_cuahang_index);

        // add "quantri/cuahang/create" permission
        $quantri_cuahang_create = $auth->createPermission('quantri/cuahang/create');
        $quantri_cuahang_create->description = 'Thên mới cửa hàng';
        $auth->add($quantri_cuahang_create);
        // add "quantri/cuahang/update" permission
        $quantri_cuahang_update = $auth->createPermission('quantri/cuahang/update');
        $quantri_cuahang_update->description = 'Chỉnh sửa cửa hàng';
        $auth->add($quantri_cuahang_update);
        // add "quantri/cuahang/view" permission
        $quantri_cuahang_view = $auth->createPermission('quantri/cuahang/view');
        $quantri_cuahang_view->description = 'Chi tiết cửa hàng';
        $auth->add($quantri_cuahang_view);
        // add "quantri/cuahang/delete" permission
        $quantri_cuahang_delete = $auth->createPermission('quantri/cuahang/delete');
        $quantri_cuahang_delete->description = 'Xóa cửa hàng';
        $auth->add($quantri_cuahang_delete);

        $auth->addChild($author, $quantri_cuahang_index);
        $auth->addChild($manager, $quantri_cuahang_create);
        $auth->addChild($manager, $quantri_cuahang_update);
        $auth->addChild($author, $quantri_cuahang_view);
        $auth->addChild($manager, $quantri_cuahang_delete);


    }

}
