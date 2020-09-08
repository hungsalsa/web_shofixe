<?php

namespace backend\modules\khachhang\controllers;

use Yii;
use backend\modules\khachhang\models\KhachHang;
use backend\modules\khachhang\models\KhachHangSearch;
use backend\modules\khachhang\models\KhXe;
use backend\modules\khachhang\models\KhXeSearch;
use backend\modules\quantri\models\Motorbike;
use backend\modules\sanpham\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * KhachhangController implements the CRUD actions for KhachHang model.
 */
class KhachhangController extends Controller
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
     * Lists all KhachHang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KhachHangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KhachHang model.
     * @param integer $idKH
     * @param string $phone
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // $kh = new KhXe();
        // dbg($kh->getSubkhachhang($id));

        

       $searchModel = new KhXeSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       $dataProvider->query->andWhere('id_KH = '.$id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider'=>$dataProvider
        ]);
    }

    /**
     * Creates a new KhachHang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KhachHang();

        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor = array();
        }


        $model->status = 1;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $modelsKHXe = [new KhXe];


        if ($model->load($post = Yii::$app->request->post())) {
            $model->name = ucwords($post['KhachHang']['name']);
            $model->address = ucwords($post['KhachHang']['address']);
// echo ucwords('test nao');
// echo '<pre>';print_r($post);
            // echo ucwords('minh anh');
// die;
            $modelsKHXe = Model::createMultiple(KhXe::classname());
            Model::loadMultiple($modelsKHXe, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsKHXe),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsKHXe) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db1->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsKHXe as $modelKHXe) {
                            $modelKHXe->bks = strtoupper($modelKHXe->bks);
                            $modelKHXe->id_KH = $model->idKH;
                            if (! ($flag = $modelKHXe->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        Yii::$app->session->setFlash('messeage','Bạn đã thêm thành công khách hàng: '.$model->name.' - SĐT: '.$model->phone);
                        $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->idKH]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        //     return $this->redirect(['view', 'idKH' => $model->idKH, 'phone' => $model->phone]);
        // }

        return $this->render('create', [
            'model' => $model,
            'dataMotor' => $dataMotor,
            'modelsKHXe' => (empty($modelsKHXe)) ? [new KhXe] : $modelsKHXe
        ]);
    }

    /**
     * Updates an existing KhachHang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idKH
     * @param string $phone
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->status = true;
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        $modelsKHXe = $model->xeKH;

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'idKH' => $model->idKH, 'phone' => $model->phone]);
        // }

        if ($model->load($post = Yii::$app->request->post())) {
        // echo '<pre>';print_r($post);die;

            $model->name = ucwords($post['KhachHang']['name']);
            $model->address = ucwords($post['KhachHang']['address']);

            $oldIDs = ArrayHelper::map($modelsKHXe, 'id', 'id');
            $modelsKHXe = Model::createMultiple(KhXe::classname(), $modelsKHXe);
            Model::loadMultiple($modelsKHXe, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsKHXe, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsKHXe),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsKHXe) && $valid;

            if ($valid) {
            
                $transaction = \Yii::$app->db1->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            KhXe::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsKHXe as $modelKhXe) {
                            $modelKhXe->id_KH = $model->idKH;
                            $modelKhXe->bks = strtoupper($modelKhXe->bks);
                            if (! ($flag = $modelKhXe->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        Yii::$app->session->setFlash('messeage','Bạn đã sửa thành công khách hàng: '.$model->name.' - SĐT: '.$model->phone);
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->idKH]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            else {
                dbg($model->errors);
            }
        }        

        return $this->render('update', [
            'model' => $model,
            'dataMotor' => $dataMotor,
            'modelsKHXe' => (empty($modelsKHXe)) ? [new KhXe] : $modelsKHXe
        ]);
    }

    /**
     * Deletes an existing KhachHang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idKH
     * @param string $phone
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = Yii::$app->user->identity;
        if ($user->manager != 1) {
            throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây, chưa chia sẻ quyền');
        }
        $model = $this->findModel($id);
        $xekH = KhXe::findAll(['id_KH'=>$id]);
        foreach ($xekH as $value) {
            $value->delete();
            
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KhachHang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idKH
     * @param string $phone
     * @return KhachHang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KhachHang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
