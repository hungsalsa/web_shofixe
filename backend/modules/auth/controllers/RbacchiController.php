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
class RbacchiController extends Controller
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

        $categories_index = $auth->createPermission('chi/loaichi/index');
        $categories_create = $auth->createPermission('chi/loaichi/create');
        $categories_view = $auth->createPermission('chi/loaichi/view');

        $categories_update = $auth->createPermission('chi/loaichi/update');
        $categories_delete = $auth->createPermission('chi/loaichi/delete');

        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $categories_index);
        $auth->addChild($author, $categories_create);
        $auth->addChild($author, $categories_view);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $categories_update);
        $auth->addChild($admin, $categories_delete);
    }
    // Create Permission 
    public function actionCreate_permission()
    {
         $auth = Yii::$app->authManager;
         // $auth = new DbManager;

        
        $manager = $auth->createRole('manager');
        $author = $auth->createRole('author');



        

// add "chi/loaichi/create" permission
        $chi_loaichi_index = $auth->createPermission('chi/loaichi/index');
        $chi_loaichi_index->description = 'Danh sách loại chi';
        $auth->add($chi_loaichi_index);

        $chi_loaichi_create = $auth->createPermission('chi/loaichi/create');
        $chi_loaichi_create->description = 'thêm mới loại chi';
        $auth->add($chi_loaichi_create);
// add "chi/loaichi/update" permission
        $chi_loaichi_update = $auth->createPermission('chi/loaichi/update');
        $chi_loaichi_update->description = 'Chỉnh sửa loại chi';
        $auth->add($chi_loaichi_update);
// add "chi/loaichi/view" permission
        $chi_loaichi_view = $auth->createPermission('chi/loaichi/view');
        $chi_loaichi_view->description = 'chi tiết loại chi';
        $auth->add($chi_loaichi_view);
// add "chi/loaichi/delete" permission
        $chi_loaichi_delete = $auth->createPermission('chi/loaichi/delete');
        $chi_loaichi_delete->description = 'xóa loại chi';
        $auth->add($chi_loaichi_delete);

        $auth->addChild($author, $chi_loaichi_index);
        $auth->addChild($manager, $chi_loaichi_create);
        $auth->addChild($manager, $chi_loaichi_update);
        $auth->addChild($author, $chi_loaichi_view);
        $auth->addChild($manager, $chi_loaichi_delete);



        
    }

    public function actionIndex1()
    {
         $auth = Yii::$app->authManager;
        $manager = $auth->createRole('manager');
        $author = $auth->createRole('author');
        $admin = $auth->createRole('admin');


        $chi_khoanchi_index = $auth->createPermission('chi/khoanchi/index');
        $chi_khoanchi_index->description = 'Danh sách khoản chi';
        $auth->add($chi_khoanchi_index);

        $chi_khoanchi_create = $auth->createPermission('chi/khoanchi/create');
        $chi_khoanchi_create->description = 'thêm mới khoản chi';
        $auth->add($chi_khoanchi_create);
// add "chi/khoanchi/update" permission
        $chi_khoanchi_update = $auth->createPermission('chi/khoanchi/update');
        $chi_khoanchi_update->description = 'Chỉnh sửa khoản chi';
        $auth->add($chi_khoanchi_update);
// add "chi/khoanchi/view" permission
        $chi_khoanchi_view = $auth->createPermission('chi/khoanchi/view');
        $chi_khoanchi_view->description = 'chi tiết khoản chi';
        $auth->add($chi_khoanchi_view);
// add "chi/khoanchi/delete" permission
        $chi_khoanchi_delete = $auth->createPermission('chi/khoanchi/delete');
        $chi_khoanchi_delete->description = 'xóa khoản chi';
        $auth->add($chi_khoanchi_delete);

        $chi_khoanchi_capnhatma = $auth->createPermission('chi/khoanchi/capnhatma');
        $chi_khoanchi_capnhatma->description = 'Nhân bản các khoản chi';
        $auth->add($chi_khoanchi_capnhatma);

        // $auth->addChild($author, $chi_khoanchi_index);
        // $auth->addChild($manager, $chi_khoanchi_create);
        // $auth->addChild($manager, $chi_khoanchi_update);
        // $auth->addChild($author, $chi_khoanchi_view);
        // $auth->addChild($manager, $chi_khoanchi_delete);
        $auth->addChild($manager, $chi_khoanchi_capnhatma);


        // $chi_chitietchi_index = $auth->createPermission('chi/chitietchi/index');
        // $chi_chitietchi_index->description = 'Danh sách chi tiết chi';
        // $auth->add($chi_chitietchi_index);

        $chi_chitietchi_create = $auth->createPermission('chi/chitietchi/create');
        $chi_chitietchi_create->description = 'thêm mới chi tiết chi';
        $auth->add($chi_chitietchi_create);

        $chi_chitietchi_update = $auth->createPermission('chi/chitietchi/update');
        $chi_chitietchi_update->description = 'Chỉnh sửa chi tiết chi';
        $auth->add($chi_chitietchi_update);

        $chi_chitietchi_view = $auth->createPermission('chi/chitietchi/view');
        $chi_chitietchi_view->description = 'chi tiết chi tiết chi';
        $auth->add($chi_chitietchi_view);

        $chi_chitietchi_delete = $auth->createPermission('chi/chitietchi/delete');
        $chi_chitietchi_delete->description = 'xóa chi tiết chi';
        $auth->add($chi_chitietchi_delete);

        // $auth->addChild($admin, $chi_chitietchi_index);
        $auth->addChild($admin, $chi_chitietchi_create);
        $auth->addChild($admin, $chi_chitietchi_update);
        $auth->addChild($admin, $chi_chitietchi_view);
        $auth->addChild($admin, $chi_chitietchi_delete);
        
    }

    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
         $manager = $auth->createRole('manager');
        $author = $auth->createRole('author');

        // khoản chi khác
        $quantri_chingaykhac_index = $auth->createPermission('chi/chingaykhac/index');
        $quantri_chingaykhac_index->description = 'Danh sách khoản chi khác';
        $auth->add($quantri_chingaykhac_index);

        // add "chi/chingaykhac/create" permission
        $quantri_chingaykhac_create = $auth->createPermission('chi/chingaykhac/create');
        $quantri_chingaykhac_create->description = 'Thên mới khoản chi khác';
        $auth->add($quantri_chingaykhac_create);
        // add "chi/chingaykhac/update" permission
        $quantri_chingaykhac_update = $auth->createPermission('chi/chingaykhac/update');
        $quantri_chingaykhac_update->description = 'Chỉnh sửa khoản chi khác';
        $auth->add($quantri_chingaykhac_update);
        // add "chi/chingaykhac/view" permission
        $quantri_chingaykhac_view = $auth->createPermission('chi/chingaykhac/view');
        $quantri_chingaykhac_view->description = 'Chi tiết khoản chi khác';
        $auth->add($quantri_chingaykhac_view);
        // add "chi/chingaykhac/delete" permission
        $quantri_chingaykhac_delete = $auth->createPermission('chi/chingaykhac/delete');
        $quantri_chingaykhac_delete->description = 'Xóa khoản chi khác';
        $auth->add($quantri_chingaykhac_delete);

        $auth->addChild($author, $quantri_chingaykhac_index);
        $auth->addChild($author, $quantri_chingaykhac_create);
        $auth->addChild($author, $quantri_chingaykhac_update);
        $auth->addChild($author, $quantri_chingaykhac_view);
        $auth->addChild($author, $quantri_chingaykhac_delete);
        
        // dụng cụ thiết bị
        $quantri_dungcu_thietbi_index = $auth->createPermission('chi/dungcu-thietbi/index');
        $quantri_dungcu_thietbi_index->description = 'Danh sách dụng cụ thiết bị';
        $auth->add($quantri_dungcu_thietbi_index);

        // add "chi/dungcu-thietbi/create" permission
        $quantri_dungcu_thietbi_create = $auth->createPermission('chi/dungcu-thietbi/create');
        $quantri_dungcu_thietbi_create->description = 'Thên mới dụng cụ thiết bị';
        $auth->add($quantri_dungcu_thietbi_create);
        // add "chi/dungcu-thietbi/update" permission
        $quantri_dungcu_thietbi_update = $auth->createPermission('chi/dungcu-thietbi/update');
        $quantri_dungcu_thietbi_update->description = 'Chỉnh sửa dụng cụ thiết bị';
        $auth->add($quantri_dungcu_thietbi_update);
        // add "chi/dungcu-thietbi/view" permission
        $quantri_dungcu_thietbi_view = $auth->createPermission('chi/dungcu-thietbi/view');
        $quantri_dungcu_thietbi_view->description = 'Chi tiết dụng cụ thiết bị';
        $auth->add($quantri_dungcu_thietbi_view);
        // add "chi/dungcu-thietbi/delete" permission
        $quantri_dungcu_thietbi_delete = $auth->createPermission('chi/dungcu-thietbi/delete');
        $quantri_dungcu_thietbi_delete->description = 'Xóa dụng cụ thiết bị';
        $auth->add($quantri_dungcu_thietbi_delete);

        
        $auth->addChild($author, $quantri_dungcu_thietbi_index);
        $auth->addChild($manager, $quantri_dungcu_thietbi_create);
        $auth->addChild($manager, $quantri_dungcu_thietbi_update);
        $auth->addChild($author, $quantri_dungcu_thietbi_view);
        $auth->addChild($manager, $quantri_dungcu_thietbi_delete);

        // vật tư tiêu hao
        $quantri_vattutieuhao_index = $auth->createPermission('chi/vattutieuhao/index');
        $quantri_vattutieuhao_index->description = 'Danh sách vật tư tiêu hao';
        $auth->add($quantri_vattutieuhao_index);

        // add "chi/vattutieuhao/create" permission
        $quantri_vattutieuhao_create = $auth->createPermission('chi/vattutieuhao/create');
        $quantri_vattutieuhao_create->description = 'Thên mới vật tư tiêu hao';
        $auth->add($quantri_vattutieuhao_create);
        // add "chi/vattutieuhao/update" permission
        $quantri_vattutieuhao_update = $auth->createPermission('chi/vattutieuhao/update');
        $quantri_vattutieuhao_update->description = 'Chỉnh sửa vật tư tiêu hao';
        $auth->add($quantri_vattutieuhao_update);
        // add "chi/vattutieuhao/view" permission
        $quantri_vattutieuhao_view = $auth->createPermission('chi/vattutieuhao/view');
        $quantri_vattutieuhao_view->description = 'Chi tiết vật tư tiêu hao';
        $auth->add($quantri_vattutieuhao_view);
        // add "chi/vattutieuhao/delete" permission
        $quantri_vattutieuhao_delete = $auth->createPermission('chi/vattutieuhao/delete');
        $quantri_vattutieuhao_delete->description = 'Xóa vật tư tiêu hao';
        $auth->add($quantri_vattutieuhao_delete);

        $auth->addChild($author, $quantri_vattutieuhao_index);
        $auth->addChild($manager, $quantri_vattutieuhao_create);
        $auth->addChild($manager, $quantri_vattutieuhao_update);
        $auth->addChild($author, $quantri_vattutieuhao_view);
        $auth->addChild($manager, $quantri_vattutieuhao_delete);
    }
}
