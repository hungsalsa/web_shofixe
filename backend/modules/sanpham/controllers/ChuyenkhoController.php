<?php

namespace backend\modules\sanpham\controllers;

use Yii;
use backend\modules\sanpham\models\ProductTransfer;
use backend\modules\sanpham\models\Capnhat;
use backend\modules\sanpham\models\ProductTransferSearch;
use backend\modules\sanpham\models\ProductTransferDetail;
use backend\modules\sanpham\models\ProductTransferDetailSearch;
use backend\modules\quantri\models\CuaHang;
use backend\modules\quantri\models\Employee;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductDiary;
use backend\modules\sanpham\models\TransferDiary;
use backend\modules\sanpham\models\Model;
use backend\modules\common\models\SanphamThongke;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\HttpException;
/**
 * ChuyenkhoController implements the CRUD actions for ProductTransfer model.
 */
class ChuyenkhoController extends Controller
{
    /**
     * @inheritdoc
     */
    public $userlog;
    
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
                    'kiemtrachuyen' => ['post'],
                    'delete-multiple' => ['post'],
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
      if($action->id =='ignore' || $action->id =='accept')
        {
            $this->enableCsrfValidation = false;
        }
      //return true;
        $this->userlog = Yii::$app->user->identity;
        return parent::beforeAction($action);
    }

    /**
     * Lists all ProductTransfer models.
     * @return mixed
     */

    public function actionUpdate_status()
    {
        $model = new Capnhat();

        $cuahang = new CuaHang();
        $cuahang = $cuahang->getCuahang_ByUser();

        $yesterday = date('Y/m/d', strtotime('-1 day', strtotime(date("Y/m/d"))));


        $data = ProductTransfer::find()
                ->where(['in','status',[0,1]])
                ->andWhere(['<=','day',$yesterday])
                ->orderBy(['day' => SORT_DESC,'cuahang_id'=>SORT_ASC])->all();

        $count['cuahang_id'] = [1,2,3,4,5];
        foreach ($count['cuahang_id'] as $value) {
            $count[$value] = ProductTransfer::find()
            // ->where(['status'=>0,'cuahang_id'=>$value])
            ->andWhere(['in','status',[0,1]])
            ->andWhere(['cuahang_id'=>$value])
            ->andWhere(['<=','day',$yesterday])->count();
        }

        if ($model->load($post = Yii::$app->request->post())) {

            // if ($post['Capnhat']['status'] == 1 && !empty($data)) {
            //     foreach ($data as $order) {
            //         // print_r($dichvu);
            //         $order->status = 1;
            //         if($order->save(false)){
            //             print_r($order->errors);
            //         }
            //     }
            // }

            return $this->redirect(['update_status']);
        }

        return $this->render('status', [
            'model' => $model,
            'data' => $data,
            'count'=>$count,
            'cuahang'=>$cuahang,
            'title' => 'Cập nhật trạng thái xuất nội bộ',
        ]);
    }

    public function actionKiemtrachuyen()
    {
        if ($post = Yii::$app->request->post()) {
            $id = $post['id'];
            // $cuahang_id = $post['cuahang_id'];
            $check = true;
            $message = '';
            $vitri = Product::find()->select(['location','idPro','cuahang_id','proName'])->where(['id'=>$id])->one();
            if ($vitri->location == 0) {
                $message .= $vitri->proName .' chưa có vị trí \\n';
            }
            $tonkho = SanphamThongke::find('slton')->select('slton')->where(['masp'=>$vitri->idPro,'cuahang_id'=>$vitri->cuahang_id])->one();
            if ($tonkho->slton <= 0) {
                $message .= $vitri->proName .' Số lượng tồn < 0';
            }
            if ($vitri->location == 0 || $tonkho->slton <= 0) { $check = false;}
            // $check = $dichvu->checkVitri($id,$cuahang_id);


            $result = [
                'id' => $id,
                'vitri' => $vitri->location,
                'tonkho' => $tonkho->slton,
                'check' => $check,
                'message' => $message
            ];
            return json_encode($result);
        }
        return json_encode(['id'=>'']);
    }
    public function actionIndex()
    {
        $searchModel = new ProductTransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $user = Yii::$app->user->identity;
        if ($user->id != 1) {
           throw new HttpException(403, 'Bạn không có quyền vào đây, chưa chia sẻ quyền');
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionXuatkho()
    {
        // dbg(Yii::$app->request->referrer);
        $searchModel = new ProductTransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $id = $this->findIdCuahang()->cuahang_id;
        $dataProvider->query->andWhere(['in', 'cuahang_id', json_decode($id)]);
        // $dataProvider->query->andWhere(['=', 'type', 0]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionNhapkho()
    {
        $searchModel = new ProductTransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $id = $this->findIdCuahang()->cuahang_id;
        $dataProvider->query->andWhere(['in', 'chuyenden_cuahang', json_decode($id)]);
        $dataProvider->query->andWhere(['status'=> [1,2]]);

        return $this->render('nhapkho', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductTransfer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new ProductTransferDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('id_transfer = '.$id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ProductTransfer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductTransfer();
        $productdiary = new ProductDiary();
        $transferdiary = new TransferDiary();

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahang_ByUser();
        $dataChuyen = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }
        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cuahang_id = $key;
                unset($dataChuyen[$key]);
            }
        }

        $dataEmployee = ArrayHelper::map(Employee::findAll(['status'=>true]),'id','name');
        if(empty($dataEmployee)){
            throw new NotFoundHttpException('Không có nhân viên, bạn phải tạo thêm nhân viên');
        }

        $product = new Product();
        $cache = Yii::$app->cache;
        if ($cache->get('cache_app_danhsachsp_user') === false) {
            // Laays danh sach san pham theo user dang nhap
            $dataProduct = ArrayHelper::map($product->getConcatAllProduct(),'id','proName');
            if(empty($dataProduct)){
                throw new NotFoundHttpException('Không có sản phẩm nào tại cửa hàng bạn quản lý, hãy tạo thêm sản phẩm trước khi vào đây !');
            }
            Yii::$app->cache->set('cache_app_danhsachsp_user', $dataProduct, 28800);//set cache trong 8 tieng
        }

        $dataStatus = [0 =>'Lưu tạm',1=>'Chuyển kho'];

        $model->status = 0;
        $model->type = 0;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = $model->user_update = Yii::$app->user->id;

        $modelsProductTransferDetail = [new ProductTransferDetail];

        if ($model->load($post = Yii::$app->request->post())) {
            $date = date('Y-m-d',strtotime($_POST['ProductTransfer']['day']));
            $model->day = $date;

            $modelsProductTransferDetail = Model::createMultiple(ProductTransferDetail::classname());
            Model::loadMultiple($modelsProductTransferDetail, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsProductTransferDetail),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProductTransferDetail) && $valid;
            
            if ($valid) {

                $transaction = \Yii::$app->db1->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsProductTransferDetail as $modelProductTransferDetail) {
                            $modelProductTransferDetail->id_transfer = $model->id_transfer;
                            if (! ($flag = $modelProductTransferDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        // thêm vào nhật ký
                        // $transferdiary->id_transfer
                        return $this->redirect(['view', 'id' => $model->id_transfer]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataStatus' => $dataStatus,
            'dataCuahang' => $dataCuahang,
            'dataChuyen' => $dataChuyen,
            'dataEmployee' => $dataEmployee,
            // 'dataProduct' => $dataProduct,
            'modelsProductTransferDetail' => (empty($modelsProductTransferDetail)) ? [new ProductTransferDetail] : $modelsProductTransferDetail
        ]);
    }

    public function actionUpdate($id)
    {
        // dbg($this->userlog);
        $model = $this->findModel($id);
        $productdiary = new ProductDiary();

        if($model->status == 2 && $this->findIdCuahang()->manager != 1){
            throw new NotFoundHttpException('Hàng đã chấp nhận chuyển ko sửa được, nếu sai hãy xóa đi và thêm lại');
        }

        if(in_array($model->chuyenden_cuahang,json_decode($this->findIdCuahang()->cuahang_id)) && $model->status == 0 && $this->findIdCuahang()->manager != 1) {
            throw new NotFoundHttpException('Đơn hàng này chưa chuyển cho cửa hàng của bạn !');
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahang_ByUser();
        $dataChuyen = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }

        $dataEmployee = ArrayHelper::map(Employee::findAll(['status'=>true]),'id','name');
        if(empty($dataEmployee) && $user->username !='qlvp'){
            throw new NotFoundHttpException('Không có ai làm trong cửa hàng của bạn, hãy liên hệ với admin để hỗ trợ bạn hoặc bạn phải tạo thêm nhân viên');
        }

        $product = new Product();
        $cache = Yii::$app->cache;
        if ($cache->get('cache_app_danhsachsp_user') === false) {
            $dataProduct = ArrayHelper::map($product->getConcatAllProduct(),'id','proName');
            if(empty($dataProduct)){
                throw new NotFoundHttpException('Không có sản phẩm nào tại cửa hàng bạn quản lý, hãy tạo thêm sản phẩm trước khi vào đây !');
            }
            Yii::$app->cache->set('cache_app_danhsachsp_user', $dataProduct, 28800);//set cache trong 8 tieng
        }

        if($model->status != 0){
            if(in_array($model->chuyenden_cuahang,json_decode($this->findIdCuahang()->cuahang_id))) {
                $dataStatus = [1 =>'Chuyển kho',2=>'Chấp nhận'];
            }
            if ($model->status == 1 && in_array($model->chuyenden_cuahang,json_decode(getUser()->cuahang_id))) {
                $dataStatus = [1 =>'Đã chuyển',2=>'Chấp nhận',3=>'Từ chối'];
            }
            if ($model->status == 1 && in_array($model->cuahang_id,json_decode(getUser()->cuahang_id)) && getUser()->manager != 1) {
                $dataStatus = [1 =>'Đã chuyển'];
            }
        }else {
            $dataStatus = [0=>'Lưu tạm',1 =>'Chuyển kho'];
        }

        // if ($this->userlog->manager == 1 ) {
        //     $dataStatus = [0=>'Lưu tạm',1 =>'Chuyển kho',2=>'Chấp nhận'];
        // }
        

        $model->day = date('d-m-Y',strtotime($model->day));
        $model->updated_at = time();
        $model->user_update = Yii::$app->user->id;
        $modelsProductTransferDetail = $model->transferDetails;
        
         if($model->load($post = Yii::$app->request->post())) {
            $date = date('Y-m-d',strtotime($_POST['ProductTransfer']['day']));
            $model->day = $date;

            $oldIDs = ArrayHelper::map($modelsProductTransferDetail, 'id', 'id');
            $modelsProductTransferDetail = Model::createMultiple(ProductTransferDetail::classname(), $modelsProductTransferDetail);
            Model::loadMultiple($modelsProductTransferDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsProductTransferDetail, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsProductTransferDetail),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProductTransferDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db1->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            ProductTransferDetail::deleteAll(['id' => $deletedIDs]);
                        }
                        // echo '<pre>';
                        foreach ($modelsProductTransferDetail as $modelProductTransferDetail) { 
                            $modelProductTransferDetail->id_transfer = $model->id_transfer;
                            if (! ($flag = $modelProductTransferDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id_transfer]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataStatus' => $dataStatus,
            'dataCuahang' => $dataCuahang,
            'dataChuyen' => $dataChuyen,
            'dataEmployee' => $dataEmployee,
            // 'dataProduct' => $dataProduct,
            // 'dataAllProduct' => $dataAllProduct,
            'modelsProductTransferDetail' => (empty($modelsProductTransferDetail)) ? [new ProductTransferDetail] : $modelsProductTransferDetail,
        ]);
    }

    /**
     * Deletes an existing ProductTransfer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $productdiary = new ProductDiary();

        $user = Yii::$app->user->identity; 
        if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền xóa');
        }
        if($model->status == 2 && $user->manager != 1){
            throw new NotFoundHttpException('Bạn hàng đã chuyển được duyệt không thể xóa, hãy liên hệ admin để được hỗ trợ !');
        }
        // echo $this->findIdCuahang()->cuahang_id;die;
        if(!in_array($model->cuahang_id,json_decode($this->findIdCuahang()->cuahang_id)) && $user->manager != 1 ){
            throw new NotFoundHttpException('Bạn không có đủ quyền xóa , hãy liên hệ với admin để hỗ trợ bạn');
        }
        $product = new Product();
        // Tìm kiếm tất cả các bản ghi có id_chuyen = $id
        $productTransferDetail = ProductTransferDetail::findAll(['id_transfer'=>$id]);


        foreach ($productTransferDetail as $transfer) {
            // tìm kiếm sản phẩm với ID truyền vào
            $sp_chuyen = Product::findOne(['id'=>$transfer->pro_id,'cuahang_id'=>$model->cuahang_id]);


            if (empty($sp_chuyen)) {
                continue;
            }
            // CẬP NHẬT LẠI SỐ LƯỢNG CỬA HÀNG CHUYỂN ĐI
            $product->updateQuantityID($sp_chuyen->id,-$transfer->quantity);
            // THEM NHAT KY CUA HANG CHUYEN DI

            $proinfo = Product::findOne(['id'=>$sp_chuyen->id]);
            $productdiary->addDiary($sp_chuyen->id,$transfer->quantity,13,$model->day,$proinfo->quantity);

            // Cập nhật lại số lượng cửa hàng chuyển đến nếu cửa hàng chuyển đến chấp nhận
            if ($model->status == 2) {
                $sp_den = Product::findOne(['idPro'=>$sp_chuyen->idPro,'cuahang_id'=>$model->chuyenden_cuahang]);

            // echo '<pre>';echo $model->status;
            // print_r($sp_den);
            // die;
                // Caapj nhaatj so luong
                $product->updateQuantityID($sp_den->id,$transfer->quantity);

                // THEM VAO NHAT KY
                $proinfo = Product::findOne(['id'=>$sp_den->id]);
                $productdiary->addDiary($sp_den->id,$transfer->quantity,14,$model->day,$proinfo->quantity);
            }
        }

        ProductTransferDetail::deleteAll(['id_transfer'=>$id]);
        $model->delete();
        // return $this->redirect(['index']);

        return $this->redirect(['xuatkho']);
    }


    protected function findModel($id)
    {
        if (($model = ProductTransfer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return $user;

       }
       throw new NotFoundHttpException('Bạn không có quyền tại cửa hàng nào');
    }
}
