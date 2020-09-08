<?php
namespace backend\modules\chi\controllers;

use Yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use backend\modules\chi\models\VattuTh;
use backend\modules\chi\models\VattuThSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use backend\modules\quantri\models\Unit;
use backend\modules\quantri\models\CuaHang;
use yii\web\HttpException;
use yii\filters\AccessControl;
/**
 * VattutieuhaoController implements the CRUD actions for VattuTh model.
 */
class VattutieuhaoController extends Controller
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
     * Lists all VattuTh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VattuThSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VattuTh model.
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
     * Creates a new VattuTh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VattuTh();

        $model->status = true;
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $dataDonvitinh = ArrayHelper::map(Unit::findAll(['status'=>true]),'id','unitName');
        $dataCuahang = ArrayHelper::map(CuaHang::findAll(['id'=>json_decode(getUser()->cuahang_id)]),'id','name');
        if (count($dataCuahang) == 1) {
            $cuahang_id = array_keys($dataCuahang);
            $model->cuahang_id = $cuahang_id[0];
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            
            $model->machi = 'VTTH'.strtoupper($post['VattuTh']['machi']);
            $model->name = ucfirst($post['VattuTh']['name']);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataDonvitinh' => $dataDonvitinh,
            'dataCuahang' => $dataCuahang,
        ]);
    }

    /**
     * Updates an existing VattuTh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!in_array($model->cuahang_id,json_decode(getUser()->cuahang_id)) && getUser()->manager != 1 ) {
            throw new HttpException(403,'Vật tư này không thuộc cửa hàng của bạn :'.getUser()->fullname);
        }

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $dataDonvitinh = ArrayHelper::map(Unit::findAll(['status'=>true]),'id','unitName');

        $dataCuahang = ArrayHelper::map(CuaHang::findAll(['id'=>json_decode(getUser()->cuahang_id)]),'id','name');
        if (count($dataCuahang) == 1) {
            $cuahang_id = array_keys($dataCuahang);
            $model->cuahang_id = $cuahang_id[0];
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            $model->machi = strtoupper($post['VattuTh']['machi']);
            $model->name = ucfirst($post['VattuTh']['name']);
            // echo '<pre>';print_r($post);die; 
            // $model->makhoanchi = strtoupper($post['ChiKhoanchi']['makhoanchi']);
            // $model->name = ucfirst($post['ChiKhoanchi']['name']);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        

        return $this->render('create', [
            'model' => $model,
            'dataDonvitinh' => $dataDonvitinh,
            'dataCuahang' => $dataCuahang,
        ]);
    }

    /**
     * Deletes an existing VattuTh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!in_array($model->cuahang_id,json_decode(getUser()->cuahang_id)) && getUser()->manager != 1) {
            throw new HttpException(403,'Vật tư này không thuộc cửa hàng của bạn :'.getUser()->fullname);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the VattuTh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VattuTh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VattuTh::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
