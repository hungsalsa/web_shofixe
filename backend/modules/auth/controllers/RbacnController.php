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
class RbacnController extends Controller
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
/*
        $quanlytin_news_index = $auth->createPermission('quanlytin/news/index');
        $quanlytin_news_index->description = 'Quản lý danh sách danh mục tin tức';
        $auth->add($quanlytin_news_index);

        $quanlytin_news_create = $auth->createPermission('quanlytin/news/create');
        $quanlytin_news_create->description = 'Thêm mới danh mục tin tức';
        $auth->add($quanlytin_news_create);

        $quanlytin_news_update = $auth->createPermission('quanlytin/news/update');
        $quanlytin_news_create->description = 'Chỉnh sửa danh mục tin tức';
        $auth->add($quanlytin_news_update);

        $quanlytin_news_view = $auth->createPermission('quanlytin/news/view');
        $quanlytin_news_create->description = 'Chi tiết danh mục tin tức';
        $auth->add($quanlytin_news_view);

        $quanlytin_news_delete = $auth->createPermission('quanlytin/news/delete');
        $quanlytin_news_create->description = 'Xóa danh mục tin tức';
        $auth->add($quanlytin_news_delete);*/

        $quanlytin_news_quickchange = $auth->createPermission('quanlytin/news/quickchange');
        $quanlytin_news_quickchange->description = 'Sắp xếp nhanh tin tức';
        $auth->add($quanlytin_news_quickchange);

/*
        $auth->addChild($author, $quanlytin_news_index);
        $auth->addChild($author, $quanlytin_news_create);
        $auth->addChild($author, $quanlytin_news_view);
        $auth->addChild($author, $quanlytin_news_delete);
        $auth->addChild($author, $quanlytin_news_update);*/
        $auth->addChild($author, $quanlytin_news_quickchange);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
