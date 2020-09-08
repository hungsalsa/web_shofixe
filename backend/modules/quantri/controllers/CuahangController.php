<?php

namespace backend\modules\quantri\controllers;

use Yii;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\CuaHangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * CuahangController implements the CRUD actions for CuaHang model.
 */
class CuahangController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=> function ($rule ,$action)
                        {
                            $control = Yii::$app->controller->id;
                            $action = Yii::$app->controller->action->id;
                            $module = Yii::$app->controller->module->id;

                            $role = $module.'/'.$control.'/'.$action;
                            if (Yii::$app->user->can($role)) {
                                return true;
                            }else {
                              throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
                          }
                      }
                  ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                    'delete-multiple' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CuaHang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CuaHangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuaHang model.
     * @param integer $id
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
     * Creates a new CuaHang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    private function checkUser()
    {
        if($user = Yii::$app->user->identity){
               return $user;
       }
       throw new NotFoundHttpException('Bạn chưa đăng nhập');
    }
    public function actionCreate()
    {
        $model = new CuaHang();

        if ($this->checkUser()->manager != 1) {
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }

        $model->status = true;
        // if ($model->load(Yii::$app->request->post()) ){
        //     $errors = $model->errors;
        //     pr($data);
        //     dbg($data);
        // }
        // if (!$model->validate() && Yii::$app->request->post()) {
        //     $errors = $model->errors;
        //     pr($errors["name"][0]);
        //     dbg($errors);
        // }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CuaHang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->checkUser()->manager != 1) {
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CuaHang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CuaHang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CuaHang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CuaHang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
