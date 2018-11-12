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
class RbacController extends Controller
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

    // Create Rule 
    public function actionCreate_rule()
    {
        $auth = Yii::$app->authManager;

        // add the rule
        $rule = new \common\modules\auth\rbac\AuthorRule;
        $auth->add($rule);

        // add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

        $categories_update = $auth->createPermission('quantri/categories/update');
        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateOwnPost, $categories_update);

        $author = $auth->createPermission('author');
        // allow "author" to update their own posts
        $auth->addChild($author, $updateOwnPost);
    }

    // Create Role 
    public function actionCreate_role()
    {
        $auth = Yii::$app->authManager;
        // Author ->index/create/view
        // Admin ->{Author} and update/delete ->index/create/view

        $categories_index = $auth->createPermission('quantri/categories/index');
        $categories_create = $auth->createPermission('quantri/categories/create');
        $categories_view = $auth->createPermission('quantri/categories/view');

        $categories_update = $auth->createPermission('quantri/categories/update');
        $categories_delete = $auth->createPermission('quantri/categories/delete');

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

        $group_index = $auth->createPermission('quantri/group/index');
        $group_index->description = 'Nhóm ';
        $auth->add($group_index);

        $group_create = $auth->createPermission('quantri/group/create');
        $group_create->description = 'Nhóm ';
        $auth->add($group_create);

        $group_view = $auth->createPermission('quantri/group/view');
        $group_view->description = 'Chỉnh sửa Nhóm ';
        $auth->add($group_view);

        $group_update = $auth->createPermission('quantri/group/update');
        $group_update->description = 'Chỉnh sửa Nhóm ';
        $auth->add($group_update);

        $group_delete = $auth->createPermission('quantri/group/delete');
        $group_delete->description = 'Xóa Nhóm ';
        $auth->add($group_delete);
        
        $author = $auth->createRole('author');
        // $auth->add($author);
        $auth->addChild($author, $group_index);
        $auth->addChild($author, $group_create);
        $auth->addChild($author, $group_view);
        $auth->addChild($author, $group_update);
        $auth->addChild($author, $group_delete);

        // add "quantri/categories/index" permission
//         $categories_index = $auth->createPermission('quantri/categories/index');
//         $categories_index->description = 'quantri/categories/index';
//         $auth->add($categories_index);
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
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
