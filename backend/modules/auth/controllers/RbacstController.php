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
class RbacstController extends Controller
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
                // 'only' => ['login', 'logout', 'create'],
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

        // setting/banner
        $setting_banner_index = $auth->createPermission('setting/banner/index');
        $setting_banner_index->description = 'Danh sách banner';
        $auth->add($setting_banner_index);

        $setting_banner_create = $auth->createPermission('setting/banner/create');
        $setting_banner_create->description = 'Thêm mới banner';
        $auth->add($setting_banner_create);

        $setting_banner_update = $auth->createPermission('setting/banner/update');
        $setting_banner_update->description = 'Chỉnh sửa banner';
        $auth->add($setting_banner_update);

        $setting_banner_view = $auth->createPermission('setting/banner/view');
        $setting_banner_view->description = 'Chi tiết banner';
        $auth->add($setting_banner_view);

        $setting_banner_delete = $auth->createPermission('setting/banner/delete');
        $setting_banner_delete->description = 'Xóa banner';
        $auth->add($setting_banner_delete);


        $auth->addChild($author, $setting_banner_index);
        $auth->addChild($author, $setting_banner_create);
        $auth->addChild($author, $setting_banner_view);
        $auth->addChild($manager, $setting_banner_delete);
        $auth->addChild($author, $setting_banner_update);



        /*// setting/menu
        $setting_menu_index = $auth->createPermission('setting/menu/index');
        $setting_menu_index->description = 'Danh sách menu';
        $auth->add($setting_menu_index);

        $setting_menu_create = $auth->createPermission('setting/menu/create');
        $setting_menu_create->description = 'Thêm mới menu';
        $auth->add($setting_menu_create);

        $setting_menu_update = $auth->createPermission('setting/menu/update');
        $setting_menu_update->description = 'Chỉnh sửa menu';
        $auth->add($setting_menu_update);

        $setting_menu_view = $auth->createPermission('setting/menu/view');
        $setting_menu_view->description = 'Chi tiết menu';
        $auth->add($setting_menu_view);

        $setting_menu_delete = $auth->createPermission('setting/menu/delete');
        $setting_menu_delete->description = 'Xóa menu';
        $auth->add($setting_menu_delete);


        $auth->addChild($author, $setting_menu_index);
        $auth->addChild($author, $setting_menu_create);
        $auth->addChild($author, $setting_menu_view);
        $auth->addChild($manager, $setting_menu_delete);
        $auth->addChild($author, $setting_menu_update);
*/

        /*// Thong tin trang
        $setting_setting_index = $auth->createPermission('setting/setting/index');
        $setting_setting_index->description = 'Danh sách thông tin trang';
        $auth->add($setting_setting_index);

        // $setting_setting_create = $auth->createPermission('setting/setting/create');
        // $setting_setting_create->description = 'Thêm mới thông tin trang';
        // $auth->add($setting_setting_create);

        $setting_setting_update = $auth->createPermission('setting/setting/update');
        $setting_setting_update->description = 'Chỉnh sửa thông tin trang';
        $auth->add($setting_setting_update);

        $setting_setting_view = $auth->createPermission('setting/setting/view');
        $setting_setting_view->description = 'Chi tiết thông tin trang';
        $auth->add($setting_setting_view);

        $setting_setting_delete = $auth->createPermission('setting/setting/delete');
        $setting_setting_delete->description = 'Xóa thông tin trang';
        $auth->add($setting_setting_delete);


        $auth->addChild($author, $setting_setting_index);
        // $auth->addChild($author, $setting_setting_create);
        $auth->addChild($author, $setting_setting_view);
        $auth->addChild($manager, $setting_setting_delete);
        $auth->addChild($author, $setting_setting_update);
*/
        /*$setting_setting_modules_index = $auth->createPermission('setting/setting-modules/index');
        $setting_setting_modules_index->description = 'Danh sách Module';
        $auth->add($setting_setting_modules_index);

        $setting_setting_modules_create = $auth->createPermission('setting/setting-modules/create');
        $setting_setting_modules_create->description = 'Thêm mới Module';
        $auth->add($setting_setting_modules_create);

        $setting_setting_modules_update = $auth->createPermission('setting/setting-modules/update');
        $setting_setting_modules_update->description = 'Chỉnh sửa Module';
        $auth->add($setting_setting_modules_update);

        $setting_setting_modules_view = $auth->createPermission('setting/setting-modules/view');
        $setting_setting_modules_view->description = 'Chi tiết Module';
        $auth->add($setting_setting_modules_view);

        $setting_setting_modules_delete = $auth->createPermission('setting/setting-modules/delete');
        $setting_setting_modules_delete->description = 'Xóa Module';
        $auth->add($setting_setting_modules_delete);


        $auth->addChild($author, $setting_setting_modules_index);
        // $auth->addChild($author, $setting_setting_modules_changepassword);
        $auth->addChild($author, $setting_setting_modules_create);
        $auth->addChild($author, $setting_setting_modules_view);
        $auth->addChild($manager, $setting_setting_modules_delete);
        $auth->addChild($author, $setting_setting_modules_update);*/

    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
