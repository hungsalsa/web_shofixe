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
class RbaccateController extends Controller
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
        $admin = $auth->createRole('admin');
         // $auth = new DbManager;

        $quanlytin_categories_index = $auth->createPermission('quanlytin/categories/index');
        // $quanlytin_categories_index->description = 'Quản lý danh sách danh mục tin tức';
        // $auth->add($quanlytin_categories_index);

        $quanlytin_categories_create = $auth->createPermission('quanlytin/categories/create');
        // $quanlytin_categories_create->description = 'Thêm mới danh mục tin tức';
        // $auth->add($quanlytin_categories_create);

        $quanlytin_categories_update = $auth->createPermission('quanlytin/categories/update');
        // $quanlytin_categories_create->description = 'Chỉnh sửa danh mục tin tức';
        // $auth->add($quanlytin_categories_update);

        $quanlytin_categories_view = $auth->createPermission('quanlytin/categories/view');
        // $quanlytin_categories_create->description = 'Chi tiết danh mục tin tức';
        // $auth->add($quanlytin_categories_view);

        $quanlytin_categories_delete = $auth->createPermission('quanlytin/categories/delete');
        // $quanlytin_categories_create->description = 'Xóa danh mục tin tức';
        // $auth->add($quanlytin_categories_delete);


        // $auth->addChild($author, $quanlytin_categories_index);
        // $auth->addChild($admin, $quanlytin_categories_create);
        // $auth->addChild($author, $quanlytin_categories_view);
        // $auth->addChild($admin, $quanlytin_categories_delete);
        $auth->addChild($admin, $quanlytin_categories_update);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
