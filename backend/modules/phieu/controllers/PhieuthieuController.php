<?php

namespace backend\modules\phieu\controllers;

use Yii;
use backend\modules\phieu\models\PhieuThieu;
use backend\modules\phieu\models\PhieuGiao;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\phieu\models\PhieuThieuSearch;
use backend\modules\quantri\models\CuaHang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
/**
 * PhieuthieuController implements the CRUD actions for PhieuThieu model.
 */
class PhieuthieuController extends Controller
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
     * Lists all PhieuThieu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuThieuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            // 'id' => $id,
            // 'tencuahang'=>$cuahang->getName($giao->cuahang_id),
        ]);
    }

    public function actionDanhsach()
    {
        // tim thong tin phieu thieu ngay , so ...
        $user_cuahang = $this->findIdCuahang();
        // echo '<pre>';print_r($user);die;

        $searchModel = new PhieuThieuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['IN','cuahang_id',$user_cuahang]);

        return $this->render('danhsach', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    

    protected function findModelPhieuGiao($id)
    {
        if (($model = PhieuGiao::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    

    /**
     * Displays a single PhieuThieu model.
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
     * Creates a new PhieuThieu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate($id)
    {
        if(getUser()->view_cuahang == 1 || getUser()->manager != 1){
            throw new NotFoundHttpException('Bạn chỉ có quyền xem không có quyền thêm mới');
        }
        $model = new PhieuThieu();
        
        // Lấy thông tin phiếu giao
        $phieugiao = PhieuGiao::findOne($id);
        $Idcuahang = $this->findIdCuahang();
        if(empty($phieugiao) || !in_array($phieugiao->cuahang_id,$Idcuahang)){
            throw new NotFoundHttpException('Bạn không có quyền vào đây, hoặc cửa hàng này không thuộc quyền quản lý của bạn !');
        }

        $model->ngay_giao = $phieugiao->ngay_giao;
        $idCuahang = $model->cuahang_id = $phieugiao->cuahang_id;

        // Lấy danh sách các số phiếu của ngày giao $phieugiao->ngay_giao;
        $phieu = new PhieuSophieu();
        // $IdListSophieu = $phieu->getAllIDPhieu($phieugiao->ngay_giao,$phieugiao->cuahang_id,$phieugiao->sophieu_dau,$phieugiao->sophieu_cuoi);
        $datasophieu = $phieu->AllPhieuThieu($phieugiao->ngay_giao,$idCuahang);
        // echo '<pre>';print_r($idCuahang);die;
        if(empty($datasophieu)){
           throw new NotFoundHttpException('Không có phiếu giao nào tại cửa hàng bạn quản lý');
       }

// 
       $giaoP = new PhieuGiao();
       $daygiao =$giaoP->getAllDatePhieu();

       if(empty($daygiao)){
        throw new NotFoundHttpException('Không có ngày giao phiếu nào tại cửa hàng bạn quản lý');
    }

    $cuahang = new CuaHang();
    $dataCuahang = $cuahang->getCuahang_ByUser();
    if(empty($dataCuahang)){
        throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
    }

        // $model->cuahang_id = $id;
    $model->created_at = time();
    $model->updated_at = time();
    $model->user_add = getUser()->id;
    $model->status = true;


    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format = 'json';
        return ActiveForm::validate($model);
    }
    if ($model->load($post = Yii::$app->request->post())) {
        $PhieuThieu = $post['PhieuThieu'];

            // Id phiếu thiếu
        $idphieu = $PhieuThieu['so_phieu'];
            // Danh sách số phiếu
// dbg($phieu->Sophieu($idphieu));
        $model->so_phieu = $phieu->Sophieu($idphieu);

            // tiến hành xóa phiếu
// dbg($PhieuThieu['so_phieu']);
            // if(PhieuSophieu::findOne($id_phieu_thieu)){

        if($model->save() && PhieuSophieu::deleteAll(['id'=>$PhieuThieu['so_phieu']])){
            $phieu->delete();
            return $this->redirect(['index']);
        }
    }

    return $this->render('create', [
        'model' => $model,
        'daygiao' => $daygiao,
        'sophieu' => $datasophieu,
        'dataCuahang' => $dataCuahang,
    ]);
}

    // protected function findModelPhieuSophieu($id)
    // {
    //     if (($model = PhieuSophieu::findOne($id)) !== null) {
    //         return $model;
    //     }

    //     throw new NotFoundHttpException('The requested page does not exist.');
    // }

    /**
     * Updates an existing PhieuThieu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $user = Yii::$app->user->identity;
        
        throw new NotFoundHttpException('Bạn không có quyền chỉnh sửa');
        if($user->manager != 1){
            throw new NotFoundHttpException('Bạn không có quyền chỉnh sửa');
        }

        $model = $this->findModel($id);
        
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $phieugiao = new PhieuGiao();
        $daygiao =$phieugiao->getAllDatePhieu($this->findIdCuahang());
        if(empty($daygiao)){
            throw new NotFoundHttpException('Không có ngày giao phiếu nào tại cửa hàng bạn quản lý');
        }
        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahangByID($this->findIdCuahang());
        if(empty($dataCuahang)){
            throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        }

        $phieu = new PhieuSophieu();
        $sophieu =$phieu->getAllPhieu();
        if(empty($sophieu)){
           throw new NotFoundHttpException('Không có phiếu giao nào tại cửa hàng bạn quản lý');
       }

        // $socu = $model->so_phieu;

        // echo '<pre>';print_r($socu);die;
       $so_phieu_cu = $model->so_phieu;
       $ngay_giao_cu = $model->ngay_giao;


       if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format = 'json';
        return ActiveForm::validate($model);
    }

    if ($model->load($post = Yii::$app->request->post())) {
            // Cap nhat lai so phieu da xoa truoc do trong bang phieu
        $phieuLuu = new PhieuSophieu();
        if(!$phieuLuu->checkphieuCH($so_phieu_cu,$model->cuahang_id)){

            $phieuLuu->ngay_giao = $ngay_giao_cu;
            $phieuLuu->cuahang_id = $model->cuahang_id;
            $phieuLuu->so_phieu = $so_phieu_cu;
            $phieuLuu->save();
        }
        $idphieu =  $phieu->xoaphieu($model->cuahang_id,$post['PhieuThieu']['so_phieu']);
            // Xoa phieu vua tao trong bang phieu
        if($model->save() &&PhieuSophieu::findOne($idphieu)->delete() ){
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('update', [
        'model' => $model,
        'daygiao' => $daygiao,
        'sophieu' => $sophieu,
        'dataCuahang' => $dataCuahang,
    ]);
}

    /**
     * Deletes an existing PhieuThieu model.
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

        // $sophieu = new PhieuSophieu();


        // $sophieu->so_phieu = $model->so_phieu;
        $listPhieu = explode("/",$model->so_phieu);
        
        // Lặp số phiếu lưu lại database
        foreach ($listPhieu as $value) {
            $sophieu = new PhieuSophieu();
            $sophieu->ngay_giao = $model->ngay_giao;
            $sophieu->cuahang_id = $model->cuahang_id;
            $sophieu->status = 0;
            $sophieu->so_phieu = (int)$value;
            // pr((int)$value);
            $sophieu->save();
        }
// pr(explode("/",$model->so_phieu));
// dbg($listPhieu);

        // Tìm ID ngày giao để trả về index
        // $giaophieu = new PhieuGiao();
        // $id_giao = $giaophieu->finIDphieugiao($sophieu->ngay_giao,$sophieu->cuahang_id);
        // echo '<pre>';print_r($data);
        // die;
        // if($sophieu->save()){
        $model->delete();
        // }

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhieuThieu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuThieu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuThieu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // Lấy thông tin đăng nhập (id) cửa hàng
    protected function findIdCuahang(){
     if($user = Yii::$app->user->identity){
         return json_decode($user->cuahang_id);

     }
     throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
 }
}
