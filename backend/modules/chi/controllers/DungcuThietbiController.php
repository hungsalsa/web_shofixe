<?php

namespace backend\modules\chi\controllers;

use Yii;
use backend\modules\chi\models\DungcuThietbi;
use backend\modules\chi\models\DungcuThietbiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quantri\models\Unit;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\filters\AccessControl;
/**
 * DungcuThietbiController implements the CRUD actions for DungcuThietbi model.
 */
class DungcuThietbiController extends Controller
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
     * Lists all DungcuThietbi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DungcuThietbiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DungcuThietbi model.
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
     * Creates a new DungcuThietbi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DungcuThietbi();
        $model->status = true;
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $dataDonvitinh = ArrayHelper::map(Unit::findAll(['status'=>true]),'id','unitName');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            
            $model->madungcu = 'DCTB'.strtoupper($post['DungcuThietbi']['madungcu']);
            $model->name = ucfirst($post['DungcuThietbi']['name']);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        

        return $this->render('create', [
            'model' => $model,
            'dataDonvitinh' => $dataDonvitinh,
        ]);
    }

    /**
     * Updates an existing DungcuThietbi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $dataDonvitinh = ArrayHelper::map(Unit::findAll(['status'=>true]),'id','unitName');
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            
            $model->madungcu = strtoupper($post['DungcuThietbi']['madungcu']);
            $model->name = ucfirst($post['DungcuThietbi']['name']);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
            'model' => $model,
            'dataDonvitinh' => $dataDonvitinh,
        ]);
    }

    /**
     * Deletes an existing DungcuThietbi model.
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
     * Finds the DungcuThietbi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DungcuThietbi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DungcuThietbi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
