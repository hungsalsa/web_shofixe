<?php

namespace backend\modules\khachhang\controllers;

use Yii;
use backend\modules\khachhang\models\KhChitietDv;
use backend\modules\khachhang\models\KhDichvu;
use backend\modules\khachhang\models\dichvu\Adddv;
use backend\modules\khachhang\models\KhDichvuSearch;
use backend\modules\khachhang\models\KhChitietDvSearch;
use backend\modules\khachhang\models\KhachHang;
use backend\modules\khachhang\models\KhXe;
use backend\modules\khachhang\models\KhachhangDichvuList;
use backend\modules\quantri\models\Employee;
use backend\modules\phieu\models\PhieuSophieu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quantri\models\CuaHang;
use yii\helpers\ArrayHelper;
use backend\models\Model;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

use backend\modules\khachhang\models\dichvu\GiaDv;
/**
 * KhachhangdichvuController implements the CRUD actions for KhDichvu model.
 */
class KhachhangdichvuController extends Controller
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
                        // 'matchCallback'=> function ($rule ,$action)
                        // {
                        //     $control = Yii::$app->controller->id;
                        //     $action = Yii::$app->controller->action->id;
                        //     $module = Yii::$app->controller->module->id;

                        //     $role = $module.'/'.$control.'/'.$action;
                        //     if (Yii::$app->user->can($role)) {
                        //         return true;
                        //     }else {
                        //       throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
                        //     }
                        // }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'laygia' => ['post'],
                    'subcat' => ['post'],
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
     * Lists all KhDichvu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KhDichvuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KhDichvu model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // echo  time();die;
        $searchModel = new KhChitietDvSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('id_dv = '.$id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new KhDichvu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KhDichvu();

        $adddv = new Adddv();

        $request = \Yii::$app->request;
        $idKH = $request->get('idKH','');
        $phone = $request->get('phone','');

        $xe = new KhXe();
        $dataXeKH = ArrayHelper::map($xe->getAllXekhach($idKH),'maxe','TTXEKH');
        if(empty($dataXeKH)){
            throw new NotFoundHttpException('Không có xe nào của khách hàng, hãy tạo thêm xe trước khi vào đây !');
        }

        
        if(count($dataXeKH) == 1){
            $key = array_keys($dataXeKH);
            $model->id_xe = $key[0];
        }

        $cache = Yii::$app->cache;
        if ($cache->get('Cache_dataKhachhang') == false)
        {
            $khachhang = new KhachHang();
            $dataKhachhang = $khachhang->AllKhachhang();
            $cache->set('Cache_dataKhachhang', $dataKhachhang, 28800);//set cache trong 8 tieng
        }

        $dataKhachhang = $cache->get('Cache_dataKhachhang');


        if ($cache->get('cache_app_dichvukh') === false) {
            $dichvu = new KhachhangDichvuList();
            $dataDichvu = $dichvu->getAllDichvu();
            Yii::$app->cache->set('cache_app_dichvukh', $dataDichvu, 28800);//set cache trong 8 tieng
        }

        if(getUser()->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền thêm hóa đơn');
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahang_ByUser();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }
        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cuahang_id = $key;
            }
        }
        
        
        $employee = new Employee();
        $dataEmployee = $employee->getNhanvien_id();
        if(empty($dataEmployee) && getUser()->username !='qlvp'){
            throw new NotFoundHttpException('Không có ai làm trong cửa hàng của bạn, hãy liên hệ với admin để hỗ trợ bạn hoặc bạn phải tạo thêm nhân viên');
        }

        if ($cache->get('cache_app_sophieu_ch') == false)
        {
            $phieu = new PhieuSophieu();
            $datasophieu =ArrayHelper::map($phieu->getSophieu(),'id','sophieu');
            $cache->set('cache_app_sophieu_ch', $datasophieu, 28800);//set cache trong 8 tieng
        }
        $datasophieu = $cache->get('cache_app_sophieu_ch');
        if(empty($datasophieu)){
         throw new NotFoundHttpException('Không có phiếu giao nào tại cửa hàng bạn quản lý');
     }

     $model->id_kh = $idKH;
     $model->status = 0;
     $model->thanhtoan = 0;
     $model->created_at = time();
     $model->updated_at = time();
     $model->user_add = getUser()->id;

     $modelsKhChitietDv = [new KhChitietDv];

     if ($model->load($post = Yii::$app->request->post())) 
     {
        // dbg($post);
        $date = date('Y-m-d',strtotime($_POST['KhDichvu']['day']));
        $model->day = $date;

        if ($post['KhDichvu']['id_nhanvien'] !='') 
        {
            $model->id_nhanvien = json_encode($post['KhDichvu']['id_nhanvien']);
        }
        if ($post['KhDichvu']['thanhtoan'] !='') 
        {
            $model->thanhtoan = 0;
        }
        $modelsKhChitietDv = Model::createMultiple(KhChitietDv::classname());
        Model::loadMultiple($modelsKhChitietDv, Yii::$app->request->post());
                    // ajax validation
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ArrayHelper::merge(
                ActiveForm::validateMultiple($modelsKhChitietDv),
                ActiveForm::validate($model)
            );
        }
                        // validate all models
        $valid = $model->validate();
        $valid = Model::validateMultiple($modelsKhChitietDv) && $valid;
        $total_money = 0;
        foreach ($modelsKhChitietDv as $valuect) {
            $total_money += $valuect->price;
        }

        $model->total_money = $total_money;
        if ($post['KhDichvu']['tienthu_kh'] !='' || $post['KhDichvu']['tienthu_kh'] == 0) 
        {
         $model->tienthu_kh = $total_money;
     }

        // dbg($model);
     if ($valid) {
        $transaction = \Yii::$app->db1->beginTransaction();
        try {
            if ($flag = $model->save(false)) {
                    // Cập nhật trạng thái phiếu
                if ($model->status == 1) {
                    $phieuKH = $phieu->UpdateStatus($model->sophieu,1,$model->day,$model->day);
                }
                if ($model->status == 2) {
                    $phieuKH = $phieu->UpdateStatus($model->sophieu,2,$model->day,'');
                }

                foreach ($modelsKhChitietDv as $modelKhChitietDv) {
                    $modelKhChitietDv->id_dv = $model->iddv;
                    if (! ($flag = $modelKhChitietDv->save(false))) {
                        $transaction->rollBack();
                        break;
                    }else {
                        dbg($modelKhChitietDv->errors);
                    }
                }
            }
            if ($flag) {
                Yii::$app->session->setFlash('messeage','Bạn đã thêm dịch vụ khách hàng thành công ');
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->iddv]);
            }else {
                dbg($model->errors);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }
}
// dbg($dataDichvu);
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->iddv]);
        // }

return $this->render('create', [
    'model' => $model,
    'adddv' => $adddv,
    'dataCuahang' => $dataCuahang,
    'dataKhachhang' => $dataKhachhang,
    'dataXeKH' => $dataXeKH,
    'dataEmployee' => $dataEmployee,
    'dataEmployee' => $dataEmployee,
    // 'dataDichvu' => $dataDichvu,
    'datasophieu' => $datasophieu,
    'modelsKhChitietDv' => (empty($modelsKhChitietDv)) ? [new KhChitietDv] : $modelsKhChitietDv
]);
}

    /**
     * Updates an existing KhDichvu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSubcat() {
        // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                // $xe = new KhXe();
                // $out = GiaDv::find()->select('id','price AS name')->where(['iddv'=>$cat_id])->asArray()->all();
                // foreach ($data as $value) {
                //     $out[] = ['name'=>$value->price,'id'=>$value->price];
                // }
                // $dichvu = new GiaDv();
                // $out = $dichvu->getPrice($cat_id);
                $dichvu = new KhachhangDichvuList();
                $out = $dichvu->getPricService($cat_id);
                
                
                return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    public function actionLaygia($id) {
        // $out = [];
        // if (isset($_POST['depdrop_parents'])) {
        //     $parents = $_POST['depdrop_parents'];
        //     if ($parents != null) {
        //         $cat_id = $parents[0];
        //         // $xe = new KhXe();
        //         // $out = $xe->getSubkhachhang($cat_id);

        //         $dichvu = new KhachhangDichvuList();
        //         $out = $dichvu->getPricService($cat_id);
                
                
        //         return json_encode(['output'=>$out, 'selected'=>'']);
        //     }
        // }
        // return json_encode(['output'=>'', 'selected'=>'']);
        return $id;
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->user_add != getUser()->id && getUser()->manager != 1){
            throw new NotFoundHttpException('Khách hàng này không phải bạn thêm, nên không thể sửa !');
        }

        if($model->status == 1 && getUser()->manager != 1){
            throw new HttpException(403,'Hóa đơn này tạo ngày '.Yii::$app->formatter->asDate($model->day, 'dd-M-Y').' đã xuất bạn không thể sửa !');
        }

        $xe = new KhXe();
        $dataXeKH = ArrayHelper::map($xe->getAllXekhach($model->id_kh),'maxe','TTXEKH');;
        if(empty($dataXeKH)){
            throw new NotFoundHttpException('Không có xe nào của khách hàng, hãy tạo thêm xe trước khi vào đây !');
        }
        if(count($dataXeKH) == 1){
            foreach ($dataXeKH as $key => $value) {
                $model->id_xe = $key;
            }
        }


         // echo '<pre>';
        // $khachhang = new KhachHang();
        // $dataKhachhang = ArrayHelper::map($khachhang->getOneAllKH($model->id_kh),'idKH','TTKH');

        $cache = Yii::$app->cache;
        if ($cache->get('Cache_dataKhachhang') == false)
        {
            $khachhang = new KhachHang();
            $dataKhachhang = $khachhang->AllKhachhang();
            $cache->set('Cache_dataKhachhang', $dataKhachhang, 28800);//set cache trong 8 tieng
        }

        $dataKhachhang = $cache->get('Cache_dataKhachhang');
        // $dataKhachhang = $dataKhachhang[$model->id_kh];
// dbg($dataKhachhang);

        $dichvu = new KhachhangDichvuList();
        $cache = Yii::$app->cache;
        if ($cache->get('cache_app_dichvukh') === false) {

            $dataDichvu = ArrayHelper::map($dichvu->getAllDichvu(),'id','TTDV');
            
            Yii::$app->cache->set('cache_app_dichvukh', $dataDichvu, 28800);//set cache trong 8 tieng
            unset($dataDichvu);
        }
        
        if(getUser()->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền thêm hóa đơn');
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahang_ByUser();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }
        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cuahang_id = $key;
            }
        }
        
        
        $employee = new Employee();
        $dataEmployee = $employee->getNhanvien_id();
        if(empty($dataEmployee) && getUser()->username !='qlvp'){
            throw new NotFoundHttpException('Không có ai làm trong cửa hàng của bạn, hãy liên hệ với admin để hỗ trợ bạn hoặc bạn phải tạo thêm nhân viên');
        }
        
        if ($cache->get('cache_app_sophieu_ch') == false)
        {
            $phieu = new PhieuSophieu();
            $datasophieu =ArrayHelper::map($phieu->getSophieu(),'id','sophieu');
            $cache->set('cache_app_sophieu_ch', $datasophieu, 28800);//set cache trong 8 tieng
        }
        $datasophieu = $cache->get('cache_app_sophieu_ch');
        
        if(empty($datasophieu)){
           throw new NotFoundHttpException('Không có phiếu giao nào tại cửa hàng bạn quản lý');
       }

       if ($model->id_nhanvien != '') {
        $model->id_nhanvien = json_decode($model->id_nhanvien);
    }
        // $model->id_kh = $idKH;
    $model->updated_at = time();
    $model->user_add = Yii::$app->user->id;

    $modelsKhChitietDv = $model->chitietdv;
            
    if ($model->load($post = Yii::$app->request->post())) {

            // $date = date('Y-m-d',strtotime($_POST['KhDichvu']['day']));
        $date = Yii::$app->formatter->asDate(strtotime($_POST['KhDichvu']['day']), "php:Y-m-d");
        $model->day = $date;

        if ($post['KhDichvu']['id_nhanvien'] !='') {
           $model->id_nhanvien = json_encode($post['KhDichvu']['id_nhanvien']);
       }
       if ($post['KhDichvu']['thanhtoan'] !='') {
           $model->thanhtoan = 0;
       }

       $oldIDs = ArrayHelper::map($modelsKhChitietDv, 'id', 'id');
       $modelsKhChitietDv = Model::createMultiple(KhChitietDv::classname(), $modelsKhChitietDv);
       Model::loadMultiple($modelsKhChitietDv, Yii::$app->request->post());
       $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsKhChitietDv, 'id', 'id')));

            // ajax validation
       if (Yii::$app->request->isAjax) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ArrayHelper::merge(
            ActiveForm::validateMultiple($modelsKhChitietDv),
            ActiveForm::validate($model)
        );
        }

                // validate all models
        $valid = $model->validate();
        $valid = Model::validateMultiple($modelsKhChitietDv) && $valid;

        $total_money = 0;
        foreach ($modelsKhChitietDv as $valuect) {
            $total_money += $valuect->price;
        }
        $model->total_money = $total_money;
            if ($post['KhDichvu']['tienthu_kh'] !='' || $post['KhDichvu']['tienthu_kh'] == 0) {
             $model->tienthu_kh = $total_money;
         }

         if ($valid) {
            $transaction = \Yii::$app->db1->beginTransaction();
            try {
                if ($flag = $model->save(false)) {
                    if ($model->status == 1) {
                        $phieuKH = $phieu->UpdateStatus($model->sophieu,1,$model->day,$model->day);
                    }
                    if ($model->status == 2) {
                        $phieuKH = $phieu->UpdateStatus($model->sophieu,2,$model->day,'');
                    }
                    if (! empty($deletedIDs)) {
                        KhChitietDv::deleteAll(['id' => $deletedIDs]);
                    }
                    foreach ($modelsKhChitietDv as $modelChitietDv) {
                        $modelChitietDv->id_dv = $model->iddv;
                        if (! ($flag = $modelChitietDv->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
                if ($flag) {
                    Yii::$app->session->setFlash('messeage','Bạn đã sửa dịch vụ khách hàng thành công');
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->iddv]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
    }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->iddv]);
        // }



    return $this->render('update', [
        'model' => $model,
        'dataCuahang' => $dataCuahang,
        'dataKhachhang' => $dataKhachhang,
        'dataXeKH' => $dataXeKH,
        'dataEmployee' => $dataEmployee,
        // 'dataDichvu' => $dataDichvu,
        'datasophieu' => $datasophieu,
        'modelsKhChitietDv' => (empty($modelsKhChitietDv)) ? [new KhChitietDv] : $modelsKhChitietDv
    ]);
    }

    /**
     * Deletes an existing KhDichvu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->user_add != getUser()->id && getUser()->manager != 1){
            throw new NotFoundHttpException('Khách hàng này không phải bạn thêm, nên không thể sửa !');
        }

        if(getUser()->manager != 1 && $model->status == 1){
            throw new NotFoundHttpException('Bạn không được xóa dịch vụ khi đã xuất !');
        }
        if ($model->delete()) {
            $phieu = new PhieuSophieu();
            $phieuKH = $phieu->UpdateStatus($model->sophieu,0,'','');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the KhDichvu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KhDichvu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KhDichvu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findIdCuahang(){
     if($user = Yii::$app->user->identity){
         return $user;

     }
     throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
 }
}
