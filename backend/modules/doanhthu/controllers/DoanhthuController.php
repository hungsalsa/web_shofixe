<?php

namespace backend\modules\doanhthu\controllers;

use Yii;
use backend\modules\doanhthu\models\DoanhThu;
use backend\modules\doanhthu\models\DoanhthuKhac;
use backend\modules\doanhthu\models\CuahangNgay;
use backend\modules\doanhthu\models\DoanhThuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\Employee;
use backend\modules\chi\models\Chingay;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * DoanhthuController implements the CRUD actions for DoanhThu model.
 */
class DoanhthuController extends Controller
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
     * Lists all DoanhThu models.
     * @return mixed
     */
    
    
    
    public function actionIndex()
    {
        // Yii::$app->session->setFlash('messeage','Bạn đã thêm thành công :');
        $id = $this->findIdCuahang();
        $searchModel = new DoanhThuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['in', 'dt.cua_hang', $id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DoanhThu model.
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
     * Creates a new DoanhThu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DoanhThu();


        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahang_ByUser();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }
        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cua_hang = $key;
            }
        }
// print_r($dataCuahang);die;
        $employee = new Employee();
        $dataEmployee = $employee->getNhanvien_id();
        if(empty($dataEmployee)){
            throw new NotFoundHttpException('Không có ai làm trong cửa hàng của bạn, hãy liên hệ với admin để hỗ trợ bạn hoặc bạn phải tạo thêm nhân viên');
        }

        $model->status = 0;
        $model->tien_le = 0;
        $model->tt_ck = 0;
        $model->tt_the = 0;
        $model->created_at = time();
        $model->updated_at = time();
        // $model->status = true;
        $model->user_add = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }


         if ($model->load($post = Yii::$app->request->post())) {

             $ngay_thu = Yii::$app->formatter->asDate($post['DoanhThu']['ngay'], 'Y-M-d');

            // Laays tien chi cua ngay nay, va cua cua hang 
            $chi = new Chingay();
            $money_chi = $chi->get_Money_Chingay($ngay_thu,$post['DoanhThu']['cua_hang']);
            
            // echo '<pre>';print_r($post);die;

            $model->ngay = $ngay_thu;
            $model->tien_chi = $money_chi;

            // Tong doanh thu theo phieu
            $doanhthu_ngay = $post['DoanhThu']['tt_ck'] + $post['DoanhThu']['tt_the'] + $post['DoanhThu']['tt_tien_mat'];
            // gan vao tong_doanh_thu_phieu
            $model ->tong_doanh_thu_phieu = $doanhthu_ngay;


            // Tiền mặt thực tế = tiền hòm + tiền lẻ
            $tien_mat_tt = $post['DoanhThu']['tien_hom'] + $post['DoanhThu']['tien_le'] ;
            $model->tong_tien_mat = $tien_mat_tt;

            // Khoan thu khac
            // Cộng tất cả các khoản thu khác, lặp tất cả các post
            

            // Chênh lệch tính theo tiền thừa hay thiếu, nếu tiền > tiền phiếu = thừa
            $model->chenh_lech = $tien_mat_tt + $money_chi - $post['DoanhThu']['giao_sang'] - $doanhthu_ngay;

            // Tính doanh thu thực //Tất cả đều trừ chênh lệch
            $model->doanh_thu_thuc = $doanhthu_ngay - abs($tien_mat_tt + $money_chi - $post['DoanhThu']['giao_sang'] - $doanhthu_ngay);


            if ($model->save()) {
                Yii::$app->session->setFlash('messeage','Bạn đã thêm thành công :'.$model->ngay);
                // Lưu thêm vào bàng cuahang--Ngay
                $cuahang_ngay = new CuahangNgay();
                $cuahang_ngay->checkExits_Save($model->ngay,$model->cua_hang);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'dataEmployee' => $dataEmployee,
        ]);
    }

    /**
     * Updates an existing DoanhThu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // echo '<pre>';print_r($model);die;

        $user = Yii::$app->user->identity;
        if($model->status == 1 && $user->username != 'admin'){
            throw new NotFoundHttpException('Bản ghi này đã xuất, bạn ko thể sửa, nếu bạn muốn sửa hãy liên hệ với admin');
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahangByID($this->findIdCuahang());
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }

        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cua_hang = $key;
            }
        }

        $employee = new Employee();
        $dataEmployee = $employee->getEmployeeByID($this->findIdCuahang());
        if(empty($dataEmployee)){
            throw new NotFoundHttpException('Không có ai làm trong cửa hàng của bạn, hãy liên hệ với admin để hỗ trợ bạn');
        }
        

        $model->ngay = Yii::$app->formatter->asDate($model->ngay, 'd-M-Y');

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {


            $ngay_thu = Yii::$app->formatter->asDate($post['DoanhThu']['ngay'], 'Y-M-d');
            $chi = new Chingay();
            $money_chi = $money_chi = $chi->get_Money_Chingay($ngay_thu,$post['DoanhThu']['cua_hang']);
            
            $model->ngay = $ngay_thu;
            $model->tien_chi = $money_chi;

            // Tong doanh thu theo phieu
            $doanhthu_ngay = $post['DoanhThu']['tt_ck'] + $post['DoanhThu']['tt_the'] + $post['DoanhThu']['tt_tien_mat'];
            // gan vao tong_doanh_thu_phieu
            $model ->tong_doanh_thu_phieu = $doanhthu_ngay;


            // Tiền mặt thực tế = tiền hòm + tiền lẻ
            $tien_mat_tt = $post['DoanhThu']['tien_hom'] + $post['DoanhThu']['tien_le'] ;
            $model->tong_tien_mat = $tien_mat_tt;

            // Khoan thu khac
            // Cộng tất cả các khoản thu khác, lặp tất cả các post
            $DTthukhac = new DoanhthuKhac();
            $thu_khac = $DTthukhac->getAll_money_ByDoanhthu($model->id);

            $model->thu_khac = $thu_khac;

            // Chênh lệch tính theo tiền thừa hay thiếu, nếu tiền > tiền phiếu = thừa
            $model->chenh_lech = $tien_mat_tt + $money_chi - $post['DoanhThu']['giao_sang'] - $doanhthu_ngay - $thu_khac;

            // Tính doanh thu thực //Tất cả đều trừ chênh lệch
            $model->doanh_thu_thuc = $doanhthu_ngay + $thu_khac - abs($tien_mat_tt + $money_chi - $post['DoanhThu']['giao_sang'] - $doanhthu_ngay - $thu_khac);

            if ($model->save()) {
                $cuahang_ngay = new CuahangNgay();
                $cuahang_ngay->checkExits_Save($model->ngay,$model->cua_hang);
                Yii::$app->session->setFlash('messeage','Bạn đã cập nhập thành công :'.$model->ngay);
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                var_dump($model->errors);die;
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataCuahang' => $dataCuahang,
            'dataEmployee' => $dataEmployee,
        ]);
    }

    /**
     * Deletes an existing DoanhThu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;
        if($user->username != 'admin'){
            throw new NotFoundHttpException('Bạn không có quyền xóa thông tin');
        }
        if(!in_array($model->cua_hang,$this->findIdCuahang())){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào trang này');
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DoanhThu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoanhThu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DoanhThu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
    }

    // Lấy danh sách cửa hàng của user đăng nhập vào, trả về danh sách
    protected function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return json_decode($user->cuahang_id);

       }
       throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
   }

   public function actionValidation() {
        $model = new DoanhThu();
       if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }
}
