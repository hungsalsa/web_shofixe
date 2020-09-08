<?php

namespace backend\modules\phieu\controllers;

use Yii;
use backend\modules\phieu\models\PhieuGiao;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\phieu\models\PhieuGiaoSearch;
use backend\modules\quantri\models\Employee;

use backend\modules\quantri\models\CuaHang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\HttpException;
/**
 * PhieugiaoController implements the CRUD actions for PhieuGiao model.
 */
class PhieugiaoController extends Controller
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
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    
    /**
     * Lists all PhieuGiao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuGiaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['in', 'cuahang_id', $this->findIdCuahang()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhieuGiao model.
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
     * Creates a new PhieuGiao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(getUser()->manager != 1){
            throw new NotFoundHttpException('Bạn chỉ có quyền xem không có quyền thêm mới');
        }

        $model = new PhieuGiao();
        // $model->scenario = 'create';
        $model->created_at = time();
        $model->user_add = getUser()->id;
        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahang_ByUser();
        
        // lấy danh sách nhân viên cửa hàng của bạn
        $employee = new Employee();
        $dataEmployee = $employee->getNhanvien_id();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $model->status = 1;
        if ($model->load($post = Yii::$app->request->post())) {
            $giaophieu = $post['PhieuGiao'];
            $date = date('Y-m-d',strtotime($giaophieu['ngay_giao']));
            $model->ngay_giao = $date;

            $sophieu_dau =(int)$giaophieu['sophieu_dau'];
            $sophieu_cuoi =(int)$giaophieu['sophieu_cuoi'];
            $cuahang_id = $giaophieu['cuahang_id'];

            $themphieu = new PhieuSophieu();
            if($themphieu->AddGiaophieu($date,$cuahang_id,$sophieu_dau,$sophieu_cuoi) == false){
                throw new NotFoundHttpException('Không thể thêm phiếu, xem lại hoặc liên hệ quản lý');
            }

            if($model->save()){
                 // $phieu->Themphieu($date,$sophieu_dau,$sophieu_cuoi,$cuahang_id);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataEmployee' => $dataEmployee,
            'dataCuahang' => $dataCuahang,
        ]);
    }

    /**
     * Updates an existing PhieuGiao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->created_at = time();
        $model->user_add = getUser()->id;
        // Kiểm tra xem có phải quản lý không
            throw new NotFoundHttpException('Tạm thời dừng chức năng');
        if(getUser()->manager != 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền chỉnh sửa');
        }

        // if($model->status == 1 && getUser()->manager != 1){
        //         throw new NotFoundHttpException('Bạn đã xuất phiếu giao, hãy liên hệ admin để được hỗ trợ !');
        // }


        $phieu = new PhieuSophieu();

        // Xóa tất cả các phiếu có ngày giao = ngày giao cập nhật
        // $data = $phieu->XoaPhieu($model->ngay_giao);
        // $data2 = $phieu->getAll_byDate($model->ngay_giao);
        // $data2->deleteAll();

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();

        $employee = new Employee();
        $dataEmployee = $employee->getNhanvien_id();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {

            $date = date('Y-m-d',strtotime($post['PhieuGiao']['ngay_giao']));
            $model->ngay_giao = $date;

            $ngay_giao = $model->ngay_giao;
            
            $sophieu_dau =(int)$post['PhieuGiao']['sophieu_dau'];
            $sophieu_cuoi =(int)$post['PhieuGiao']['sophieu_cuoi'];
            $cuahang_id = $model->cuahang_id;

            

            $oldAttributes = $model->oldAttributes;
            $attributes = $model->attributes;

            // Nếu status chưa xuất thì ko làm gì
            if ($model->status == 1) {

                if($attributes['sophieu_dau'] != $oldAttributes['sophieu_dau'] ||  $attributes['sophieu_cuoi'] != $oldAttributes['sophieu_cuoi'] ){
                    $phieusophieu = $phieu->getPhieucapnhat($model->ngay_giao,$oldAttributes['sophieu_dau'],$oldAttributes['sophieu_cuoi'],$cuahang_id);
                    if ($phieusophieu) {
                        foreach ($phieusophieu as $value) {
                                    // print_r($value);
                            $value->delete();
                        }
                    }

                    // $phieu->Themphieu($ngay_giao,$sophieu_dau,$sophieu_cuoi,$cuahang_id);
                }

                for ($sophieu_dau; $sophieu_dau <= $sophieu_cuoi; $sophieu_dau++) {
                $themphieu = new PhieuSophieu();

                    $themphieu->ngay_giao = $date;
                    $themphieu->cuahang_id = $cuahang_id;
                    $themphieu->so_phieu = $sophieu_dau;
                    $themphieu->status = 0;
                    $themphieu->save();
            }
            }

            // print_r($model);
            // print_r($phieusophieu);
            // die;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataEmployee' => $dataEmployee,
            'dataCuahang' => $dataCuahang,
        ]);
    }

    /**
     * Deletes an existing PhieuGiao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $user = $this->login(); 
        
        if(!in_array($model->cuahang_id,$this->findIdCuahang()) && getUser()->manager != 1 ){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }

        if(getUser()->manager != 1){
                throw new HttpException(403,'Bạn không đủ quyền xóa phiếu, hãy liên hệ admin để được hỗ trợ !');
        }

        $phieu = new PhieuSophieu();
        $ngay_giao = $model->ngay_giao;
        $cuahang_id = $model->cuahang_id;
        $sophieu_dau = $model->sophieu_dau;
        $sophieu_cuoi = $model->sophieu_cuoi;
        $idList = $phieu->getAllIDPhieu($ngay_giao,$cuahang_id,$sophieu_dau,$sophieu_cuoi);

        if ($model->delete() && PhieuSophieu::deleteAll(['id'=>$idList])) {
            return $this->redirect(['index']);
            
        }else {
             throw new HttpException(403,'Xóa lỗi mất rồi, hãy liên hệ quản lý hoặc admin để được hỗ trợ !');
        }

    }

    /**
     * Finds the PhieuGiao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuGiao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelSophieu($id)
    {
        if (($model = PhieuSophieu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModel($id)
    {
        if (($model = PhieuGiao::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // Lấy thông tin đăng nhập (id) cửa hàng
    private function login(){
       if($user = Yii::$app->user->identity){
           return $user;

       }
       throw new NotFoundHttpException('Bạn chưa đăng nhập');
   }
   // Lấy thông tin đăng nhập (id) cửa hàng
    private function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return json_decode($user->cuahang_id);

       }
       throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
   }

   public function actionValidation() {
        $model = new PhieuGiao();
       if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }
}
