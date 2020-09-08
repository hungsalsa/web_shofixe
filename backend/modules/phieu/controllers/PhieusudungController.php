<?php

namespace backend\modules\phieu\controllers;

use Yii;
use backend\modules\phieu\models\PhieuSudung;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\phieu\models\PhieuTon;
use backend\modules\quantri\models\Employee;
use backend\modules\chi\models\Model;
use backend\modules\doanhthu\models\CuaHang;
use backend\modules\phieu\models\PhieuSudungSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
/**
 * PhieusudungController implements the CRUD actions for PhieuSudung model.
 */
class PhieusudungController extends Controller
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
    }

    /**
     * Lists all PhieuSudung models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuSudungSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['in', 'cuahang_id', $this->findIdCuahang()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhieuSudung model.
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
     * Creates a new PhieuSudung model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhieuSudung();
        // $model->scenario = 'createnew';
        $user = Yii::$app->user->identity;
        if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền thêm mới');
        }
        

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahangByID();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }

        $employee = new Employee();
        $dataEmployee = $employee->getNhanvien_id($this->findIdCuahang());
        dbg($dataEmployee);
        if(empty($dataEmployee)){
            throw new NotFoundHttpException('Không có ai làm trong cửa hàng của bạn, hãy liên hệ với admin để hỗ trợ bạn hoặc bạn phải tạo thêm nhân viên');
        }

        $phieu = new PhieuSophieu();
        $datasophieu =$phieu->getAllPhieu();
        if(empty($datasophieu)){
             throw new NotFoundHttpException('Không có phiếu giao nào tại cửa hàng bạn quản lý');
        }

        $dataPhieuton = $phieu->getAllPhieu('','',2);
        if(empty($dataPhieuton)){
            $dataPhieuton = [];
        }

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_create = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }


        if ($model->load($post = Yii::$app->request->post()) ) {
            $post = $post['PhieuSudung'];
            
            $date = date('Y-m-d',strtotime($post['ngay_sd']));
            $model->ngay_sd = $date;


            $sodau = $post['so_phieu_dau'];
            $socuoi = $post['so_phieu_cuoi'];
            $cuahang_id = $post['cuahang_id'];

            $phieu->updatePhieuTot($date,$cuahang_id,$sodau,$socuoi);
            // Update phiếu hủy
            // if($post['phieu_huy'] !=''){
            //     $huy_phieu = $post['phieu_huy'];
            //     $model->phieu_huy = json_encode($huy_phieu); 
            //     foreach ($huy_phieu as $value) {
            //         $phieu->updatePhieuHuy($date,$cuahang_id,$value);
            //     }
            // }

            // Update phiếu tồn
            if($post['phieu_ton'] !=''){
                $phieu_ton = $post['phieu_ton'];
                $model->phieu_ton = json_encode($phieu_ton);
                foreach ($phieu_ton as $value) {

                    // Thêm vào bảng phiếu tồn
                    $pton = new PhieuTon();
                    $pton->ngay_sd = $date;
                    $pton->status = true;
                    $pton->so_phieu_ton = $value;
                    $pton->save();

                    // update vào bảng số phiếu
                    $phieu->updatePhieuHuy($date,$cuahang_id,$value,2);
                }
            }

            echo '<pre>';print_r($post);die;
            // Update phiếu tồn ngày trước hnay thanh toán
            if($post['phieu_ton_tt'] !=''){
                $phieu_ton_tt = $post['phieu_ton_tt'];
                $model->phieu_ton_tt = json_encode($phieu_ton_tt);
                foreach ($phieu_ton_tt as $value) {
                    $phieu->updatePhieuHuy($date,$cuahang_id,$value,3);
                }
            }

            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'dataEmployee' => $dataEmployee,
            'datasophieu' => $datasophieu,
            'dataPhieuton' => $dataPhieuton,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $model->scenario = 'update';
        // echo '<pre>';print_r($model);die;
        $user = Yii::$app->user->identity;
        if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền thêm mới');
        }
        if ($user->manager != 1) {
            throw new NotFoundHttpException('Bạn không có đủ quyền vào đây , hãy liên hệ với admin để hỗ trợ bạn');
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahangByID();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }

        $employee = new Employee();
        $dataEmployee = $employee->getEmployeeByID($this->findIdCuahang());
        if(empty($dataEmployee)){
            throw new NotFoundHttpException('Không có ai làm trong cửa hàng của bạn, hãy liên hệ với admin để hỗ trợ bạn hoặc bạn phải tạo thêm nhân viên');
        }

        $phieu = new PhieuSophieu();
        $datasophieu =$phieu->getAllPhieu('',$model->cuahang_id);
        if(empty($datasophieu)){
             throw new NotFoundHttpException('Không có phiếu giao nào tại cửa hàng bạn quản lý');
        }


        if ($model->phieu_huy !='') {
            $model->phieu_huy = json_decode($model->phieu_huy);
        }
        if ($model->phieu_ton !='') {
            $model->phieu_ton = json_decode($model->phieu_ton);
        }

        $model->updated_at = time();
        $model->user_create = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }


        if ($model->load($post = Yii::$app->request->post())) {
            $post = $post['PhieuSudung'];

            // chuyen doi ngay
            $date = date('Y-m-d',strtotime($post['ngay_sd']));
            $model->ngay_sd = $date;
            // update ngay su dung phiếu
           
            $cuahang_id = $post['cuahang_id'];
            $sodau = $post['so_phieu_dau'];
            $socuoi = $post['so_phieu_cuoi'];

            // update phiếu tốt
            $phieu->updatePhieuTot($date,$cuahang_id,$sodau,$socuoi);

            // Update phiếu hủy
            if($post['phieu_huy'] !=''){
                $huy_phieu = $post['phieu_huy'];
                $model->phieu_huy = json_encode($huy_phieu);
                foreach ($huy_phieu as $value) {
                    $phieu->updatePhieuHuy($date,$cuahang_id,$value);
                }
            }

            // Update phiếu tồn
            if($post['phieu_ton'] !=''){
                $phieu_ton = $post['phieu_ton'];
                $model->phieu_ton = json_encode($phieu_ton);
                foreach ($phieu_ton as $value) {
                    $phieu->updatePhieuHuy($date,$cuahang_id,$value,2);
                }
            }

            // Update phiếu tồn ngày trước hnay thanh toán
            if($post['phieu_ton_tt'] !=''){
                $phieu_ton_tt = $post['phieu_ton_tt'];
                $model->phieu_ton_tt = json_encode($phieu_ton_tt);
                foreach ($phieu_ton_tt as $value) {
                    $phieu->updatePhieuHuy($date,$cuahang_id,$value,3);
                }
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        return $this->render('update', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'dataEmployee' => $dataEmployee,
            'datasophieu' => $datasophieu,
        ]);
    }


    public function actionDanhsachphieu() {
        $cuahang = new CuaHang();
        // $dataCH = $cuahang->getName();
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);

            $list = PhieuSophieu::find()->andWhere(['cuahang_id'=>$id])->asArray()->all();

            $selected  = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
            // $i=0;
                foreach ($list as $i => $account) {
                // $out[$account['id']] = $account['so_phieu'];
                    $out[] = [
                        'id' => $account['so_phieu'],
                        'name' => $account['so_phieu'].' -> '.$cuahang->getName($account['cuahang_id'])
                    ];
                // if ($i == 0) {
                //     $selected = $account['id'];
                // }
                }
            // Shows how you can preselect a value
                return Json::encode(['output' => $out, 'selected'=>$selected]);
            // return;
            }
        }
        return Json::encode(['output' => '', 'selected'=>'']);
    }

    


    public function actionKetoancuahang() {
        $out = [];
        $emplo = new Employee();
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);

            $list = Employee::findAll($emplo->getnhanvien($id));

            $selected  = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
            
                foreach ($list as $i => $employee) {
                // $out[$account['id']] = $account['so_phieu'];
                    $out[] = [
                        'id' => $employee['id'],
                        'name' => $employee['name']
                    ];
                // if ($i == 0) {
                //     $selected = $account['id'];
                // }
                }
            // Shows how you can preselect a value
                return Json::encode(['output' => $out, 'selected'=>$selected]);
            // return;
            }
        }
        return Json::encode(['output' => '', 'selected'=>'']);
    }


    /**
     * Updates an existing PhieuSudung model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Deletes an existing PhieuSudung model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;
        if ($user->manager != 1) {
            throw new NotFoundHttpException('Bạn không có đủ quyền xóa phiếu , hãy liên hệ với admin để hỗ trợ bạn');
        }
        // echo '<pre>';print_r($model);die;
        $phieu = new PhieuSophieu();
        $phieu->updatePhieuTot('',$model->cuahang_id,$model->so_phieu_dau,$model->so_phieu_cuoi,0);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the PhieuSudung model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuSudung the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuSudung::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return json_decode($user->cuahang_id);

       }
       throw new NotFoundHttpException('Bạn không có quyền tại cửa hàng nào');
    }
}
