<?php

namespace backend\modules\chi\controllers;

use Yii;
use backend\modules\chi\models\Chingay;
use backend\modules\chi\models\Chitietchi;
use backend\modules\chi\models\ChingaySearch;
use backend\modules\chi\models\ChitietchiSearch;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\Employee;
use backend\modules\chi\models\ChiKhoanchi;
use backend\modules\quantri\models\Motorbike;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\quantri\models\Supplier;
use backend\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\HttpException;
use yii\filters\AccessControl;
/**
 * ChingayController implements the CRUD actions for Chingay model.
 */
class ChingayController extends Controller
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
     * Lists all Chingay models.
     * @return mixed
     */
    public function actionIndex()
    {        
        $searchModel = new ChingaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chingay model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new ChitietchiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('chikhac_id = '.$id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * Creates a new Chingay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chingay();

        $model->status = 0;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $data = new CuaHang();
        $dataCuahang = $data->getCuahang_ByUser();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }
        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cuahang_id = $key;
            }
        }

        $data = new ChiKhoanchi();
        $dataKhoanchi = $data->Khoanchi_NOTIN([2]);
        // echo '<pre>';print_r($dataKhoanchi);die;
        if(empty($dataKhoanchi)){
            throw new NotFoundHttpException('Bạn Chưa tạo khoản chi nào');
        }

        $dataMotor = ArrayHelper::map(Motorbike::find()->where('status =:Status',['Status'=>true])->all(),'id','bikeName');;
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        $data = new Employee();
        $dataEmployee = $data->getNhanvien_id();

        $data = new PhieuSophieu();
        $dataSophieu = ArrayHelper::map($data->getSophieu(),'id','so_phieu');
        if(empty($dataSophieu)){
            throw new NotFoundHttpException('Chưa có số phiếu nào ở cửa hàng của bạn');
        }

        $dataSupplier = ArrayHelper::map(Supplier::find()->where('status =:Status',['Status'=>true])->all(),'id','supName');;
        if(empty($dataSupplier)){
            $dataSupplier = array();
        }
        // $dataEmployee = Emp

        // echo '<pre>';
        // print_r(count($dataSophieu));die;

        $modelsChitietchi = [new Chitietchi];

        if ($model->load($post = Yii::$app->request->post())) {
            $date = date('Y-m-d',strtotime($post['Chingay']['day']));
            $model->day = $date;

            $modelsChitietchi = Model::createMultiple(Chitietchi::classname());
            Model::loadMultiple($modelsChitietchi, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsChitietchi),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsChitietchi) && $valid;
            
            if ($valid) {
                $total_money = 0;
                foreach ($post['Chitietchi'] as $chitiet) {
                    $total_money += $chitiet['quantity']*$chitiet['money'];
                }

                $model->total_money = $total_money;

                $transaction = \Yii::$app->db1->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsChitietchi as $modelChitietchi) {
                            $modelChitietchi->chikhac_id = $model->id;
                            if (! ($flag = $modelChitietchi->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        return $this->render('create', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'dataKhoanchi' => $dataKhoanchi,
            'dataMotor' => $dataMotor,
            'dataEmployee' => $dataEmployee,
            'dataSophieu' => $dataSophieu,
            'dataSupplier' => $dataSupplier,
            'modelsChitietchi' => (empty($modelsChitietchi)) ? [new Chitietchi] : $modelsChitietchi
        ]);
    }

    /**
     * Updates an existing Chingay model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at = time();
        $model->user_add = $this->login()->id;

        if ($this->login()->manager != 1 && $model->status == 1) {
            throw new HttpException(403,'Hóa đơn này đã xuất bạn không thể sửa !, nếu muốn sửa hãy liên hệ với admin');
        }

        $data = new CuaHang();
        $dataCuahang = $data->getCuahang_ByUser();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }
        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cuahang_id = $key;
            }
        }

        $data = new ChiKhoanchi();
        $dataKhoanchi = $data->Khoanchi_NOTIN([2]);
        if(empty($dataKhoanchi)){
            throw new NotFoundHttpException('Bạn Chưa tạo khoản chi nào');
        }
// dbg($dataKhoanchi);

        $dataMotor = ArrayHelper::map(Motorbike::find()->where('status =:Status',['Status'=>true])->all(),'id','bikeName');;
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        $data = new Employee();
        $dataEmployee = $data->getNhanvien_id();

        $data = new PhieuSophieu();
        $dataSophieu = ArrayHelper::map($data->getSophieu(),'id','so_phieu');
        if(empty($dataSophieu)){
            throw new NotFoundHttpException('Chưa có số phiếu nào ở cửa hàng của bạn');
        }

        $dataSupplier = ArrayHelper::map(Supplier::find()->where('status =:Status',['Status'=>true])->all(),'id','supName');;
        if(empty($dataSupplier)){
            $dataSupplier = array();
        }

        $modelsChitietchi = $model->chitiet;

        if ($model->load($post = Yii::$app->request->post())) {
            // $date = date('Y-m-d',strtotime($post['Chingay']['day']));
            // $model->day = $date;

            $oldIDs = ArrayHelper::map($modelsChitietchi, 'id', 'id');
            $modelsChitietchi = Model::createMultiple(Chitietchi::classname(), $modelsChitietchi);
            Model::loadMultiple($modelsChitietchi, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsChitietchi, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsChitietchi),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsChitietchi) && $valid;

            if ($valid) {
                $total_money = 0;
                foreach ($post['Chitietchi'] as $chitiet) {
                    $total_money += $chitiet['quantity']*$chitiet['money'];
                }

                $model->total_money = $total_money;

                // echo '<pre>';
                // print_r($post);die;
                $transaction = \Yii::$app->db1->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Chitietchi::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsChitietchi as $modelChitietchi) {
                            $modelChitietchi->chikhac_id = $model->id;
                            if (! ($flag = $modelChitietchi->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        return $this->render('update', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'dataKhoanchi' => $dataKhoanchi,
            'dataMotor' => $dataMotor,
            'dataEmployee' => $dataEmployee,
            'dataSophieu' => $dataSophieu,
            'dataSupplier' => $dataSupplier,
            'modelsChitietchi' => (empty($modelsChitietchi)) ? [new Chitietchi] : $modelsChitietchi
        ]);
    }

    /**
     * Deletes an existing Chingay model.
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

    private function login()
    {
        if($user = Yii::$app->user->identity){
            return $user;
        }
        throw new HttpException(403,'Bạn chưa đăng nhập');
    }
    protected function findModel($id)
    {
        if (($model = Chingay::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
