<?php

namespace backend\modules\khachhang\controllers;

use Yii;
use backend\modules\khachhang\models\KhXe;
use backend\modules\khachhang\models\KhXeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * KhachhangxeController implements the CRUD actions for KhXe model.
 */
class KhachhangxeController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all KhXe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KhXeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KhXe model.
     * @param integer $idxe
     * @param integer $id_KH
     * @param string $bks
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idxe, $id_KH, $bks)
    {
        return $this->render('view', [
            'model' => $this->findModel($idxe, $id_KH, $bks),
        ]);
    }

    /**
     * Creates a new KhXe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KhXe();
        $model->status = 1;

        $user = Yii::$app->user->identity;
        if ($user->id != 1) {
            throw new NotFoundHttpException('Bạn ko thể tạo thêm !');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idxe' => $model->idxe, 'id_KH' => $model->id_KH, 'bks' => $model->bks]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KhXe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idxe
     * @param integer $id_KH
     * @param string $bks
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idxe, $id_KH, $bks)
    {
        $model = $this->findModel($idxe, $id_KH, $bks);
        $user = Yii::$app->user->identity;
        if ($user->id != 1) {
            throw new NotFoundHttpException('Bạn ko thể tạo thêm !');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idxe' => $model->idxe, 'id_KH' => $model->id_KH, 'bks' => $model->bks]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KhXe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idxe
     * @param integer $id_KH
     * @param string $bks
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idxe, $id_KH, $bks)
    {
        $user = Yii::$app->user->identity;
        if ($user->id != 1) {
            throw new NotFoundHttpException('Bạn ko thể tạo thêm !');
        }
        $this->findModel($idxe, $id_KH, $bks)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KhXe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idxe
     * @param integer $id_KH
     * @param string $bks
     * @return KhXe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idxe, $id_KH, $bks)
    {
        if (($model = KhXe::findOne(['idxe' => $idxe, 'id_KH' => $id_KH, 'bks' => $bks])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
