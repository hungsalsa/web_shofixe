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
use backend\modules\common\models\SanphamThongke;
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
                'laygia' => ['post'],
                'subcat' => ['post'],
                'delete' => ['post'],
                'suachitiet' => ['post'],
                'xoachitiet' => ['post'],
                'checkvitri' => ['post'],
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
    public function actionPrint($id)
    {
        // echo  time();die;
        $model = $this->findModel($id);
        $chitietDichvu = $model->chitietdv;
        return $this->render('print', [
            'model' => $this->findModel($id),
            'chitietDichvu' => $chitietDichvu,
            'tienchu' => ucfirst($this->convert_number_to_words($model->total_money*1000)),
        ]);
    }

    private function convert_number_to_words($number) {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'không',
            1                   => 'một',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'bốn',
            5                   => 'năm',
            6                   => 'sáu',
            7                   => 'bảy',
            8                   => 'tám',
            9                   => 'chín',
            10                  => 'mười',
            11                  => 'mười một',
            12                  => 'mười hai',
            13                  => 'mười ba',
            14                  => 'mười bốn',
            15                  => 'mười năm',
            16                  => 'mười sáu',
            17                  => 'mười bảy',
            18                  => 'mười tám',
            19                  => 'mười chín',
            20                  => 'hai mươi',
            30                  => 'ba mươi',
            40                  => 'bốn mươi',
            50                  => 'năm mươi',
            60                  => 'sáu mươi',
            70                  => 'bảy mươi',
            80                  => 'tám mươi',
            90                  => 'chín mươi',
            100                 => 'trăm',
            1000                => 'nghìn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
            $string = $dictionary[$number];
            break;
            case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
            case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->convert_number_to_words($remainder);
            }
            break;
            default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convert_number_to_words($remainder);
            }
            break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return $string;
    }

    /**
     * Creates a new KhDichvu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'mainup';
        $model = new KhDichvu();

        $adddv = new Adddv();

        $request = \Yii::$app->request;
        $idKH = $request->get('idKH','');
        // $phone = $request->get('phone','');

        $xe = new KhXe();
        $dataXeKH = $xe->getAllXekhach($idKH);
        
        if(count($dataXeKH) == 1){
            $key = array_keys($dataXeKH);
            $model->id_xe = $key[0];
        }
        $khachhang = new KhachHang();
        $dataKhachhang = $khachhang->getOneKH($idKH);
        $cache = Yii::$app->cache;
        // if ($cache->get('cache_app_dichvukh') === false) {
            $dichvu = new KhachhangDichvuList();
            $dataDichvu = $dichvu->getAllDichvu();
            // dbg($dataDichvu);
            Yii::$app->cache->set('cache_app_dichvukh', $dataDichvu, 28800);//set cache trong 8 tieng
        // }
// dbg($cache->get('cache_app_dichvukh'));

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

       if (Yii::$app->request->isAjax &&  $model->validate() && $adddv->validate()) {
        Yii::$app->response->format = 'json';
        $valid = ActiveForm::validate($model) && ActiveForm::validate($adddv);
        return $valid;
    }


    if ($model->load($post = Yii::$app->request->post())) 
    {


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
        //                 // validate all models
        // $total_money = 0;
        // foreach ($modelsKhChitietDv as $valuect) {
        //     $total_money += $valuect->price;
        // }
        // $chitiet = $post['themchitiet'];
        $chitiet = (isset($post['themchitiet'])) ? $post['themchitiet'] : false;

        $model->total_money = $total_money= (isset($chitiet['price']))?array_sum($chitiet['price']):0;
        if ($post['KhDichvu']['tienthu_kh'] !='' || $post['KhDichvu']['tienthu_kh'] == 0) 
        {
         $model->tienthu_kh = $total_money;
     }

        // dbg($model);
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
     if (isset($chitiet['name'])) {
       if ($model->save(false)) {

        foreach ($chitiet['name'] as $key => $value) {
            $chitietdv = new KhChitietDv();
            $chitietdv->id_dv = $model->iddv;
            $chitietdv->id_Pro_dv = $value;
            $chitietdv->suffixes = $chitiet['suffixes'][$key];
            $chitietdv->price = str_replace('.','',$chitiet['price'][$key]);
            $chitietdv->quantity = $chitiet['quantity'][$key];
                // KIỂM TRA NẾU LƯU CHI TIẾT THÀNH CÔNG THÌ TRỪ VÀO BẢNG TỒN KHO ĐỂ KIỂM TRA CHO NHỮNG LẦN SAU
            if($chitietdv->save()){
                pr($model->cuahang_id);
                pr($chitietdv->danhsachdv->madichvu);
                    // dbg($chitietdv->danhsachdv);
                $tonkho = SanphamThongke::findOne(['masp'=>$chitietdv->danhsachdv->madichvu,'cuahang_id'=>$model->cuahang_id]);
                if ($tonkho) {
                    $tonkho->slxuat = $tonkho->oldAttributes['slxuat'] + $chitietdv->quantity; 
                    $tonkho->slton = $tonkho->oldAttributes['slton'] - $chitietdv->quantity; 
                            // dbg($tonkho->oldAttributes['slxuat']);
                            // dbg($tonkho->oldAttributes);
                    if($tonkho->save()){
                            // dbg($tonkho);
                    }
                    
                }
            }else {
                dbg($chitietdv->errors);
            }
                // dbg($chitietdv);
        }

    }
}


        // pr($chitiet);
        // dbg($post);

    return $this->redirect(['view', 'id' => $model->iddv]);
            // }
}
    // dbg($dataDichvu);

return $this->render('create', [
    'model' => $model,
    'adddv' => $adddv,
    'dataCuahang' => $dataCuahang,
    'dataKhachhang' => $dataKhachhang,
    'dataXeKH' => $dataXeKH,
    'dataEmployee' => $dataEmployee,
            // 'dataEmployee' => $dataEmployee,
            // 'dataDichvu' => $dataDichvu,
    'datasophieu' => $datasophieu,
            // 'modelsKhChitietDv' => (empty($modelsKhChitietDv)) ? [new KhChitietDv] : $modelsKhChitietDv
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
                $dichvu = new KhachhangDichvuList();
                $out = $dichvu->getPricService($cat_id);
                
                return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    // Kiểm tra vị trí phụ tùng khi thêm dịch vụ
    public function actionCheckvitri() {
        if ($post = Yii::$app->request->post()) {
            $id = $post['id'];
            $cuahang_id = $post['cuahang_id'];
            $check = true;
            $dichvu = new KhachhangDichvuList();
            // $check = $dichvu->checkVitri($id,$cuahang_id);
            $erros ='';
            if (!$dichvu->checkVitri($id,$cuahang_id)) {
                $check = false;
                $erros .= "Sản phẩm này chưa có vị trí \n";
            }
            $madichvu = KhachhangDichvuList::find()->select(['madichvu','phutung'])->where(['id'=>$post['id']])->one();
            if($madichvu->phutung == 1 ){
                $tonkho = SanphamThongke::find('slton')->select('slton')->where(['masp'=>$madichvu->madichvu,'cuahang_id'=>$post['cuahang_id']])->one();
                if ($tonkho->slton <= 0) {
                    $check = false;
                    $erros .= "Sản phẩm này đang có số lượng tồn : $tonkho->slton \n";
                }
            }

            $result = [
                'id' => $id,
                'cuahang_id' => $cuahang_id,
                'tonkho' => (isset($tonkho->slton)) ? $tonkho->slton: 0,
                'phutung' => $madichvu->phutung,
                'check' => $check,
                'erros' => $erros,
            ];
            return json_encode($result);
        }
        return json_encode(['id'=>'']);
    }

    // Kiểm tra Số lượng phụ tùng khi thêm dịch vụ
    public function actionChecksoluong() {
        if ($post = Yii::$app->request->post()) {
            $check = true;
            $erros = '';
            $slgton = 0;
            $dichvu = KhachhangDichvuList::find()->select(['madichvu','phutung'])->where(['id'=>$post['id']])->one();
            // $dichvuss = KhachhangDichvuList::find()->select(['madichvu','phutung','tendv'])->where(['id'=>$post['id']])->asArray()->one();
            if($dichvu->phutung == 1){
                $tonkho = SanphamThongke::find('slton')->select('slton')->where(['masp'=>$dichvu->madichvu,'cuahang_id'=>$post['cuahang_id']])->one();
                $slgton = $tonkho->slton;
                if ($tonkho->slton - $post['quantity']  < 0) {
                    $check = false;
                    $erros .= "Sản phẩm này đang có số lượng tồn : $tonkho->slton \n Bạn chỉ xuất tối đa $tonkho->slton";
                }
                if ($tonkho->slton  <= 0) {
                    $check = false;
                    $erros = "Sản phẩm này đang có số lượng tồn : $tonkho->slton < 0 \n Bạn không thể xuất sản phẩm này";
                    $slgton = null;
                }
            }

            $result = [
                'check' => $check,
                'slton' => $slgton,
                'phutung' => $dichvu->phutung,
                'erros' => $erros,
            ];
            // return json_encode($result);
            return json_encode($result);
        }
        return json_encode(['id'=>'']);
    }

    // Lấy giá sản phẩm đổ tra khi chọn dịch vụ
    public function actionLaygia() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                // $xe = new KhXe();
                // $out = $xe->getSubkhachhang($cat_id);

                $dichvu = new KhachhangDichvuList();
                $out = $dichvu->getPricService($cat_id);
                
                
                return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    public function actionSuachitiet()
    {
        // $data = '';
        if ($post = Yii::$app->request->post()) {
            $id = $post['id'];
            $model = KhChitietDv::findOne($id);
            // dbg($post['id_Pro_dv']);
            // $model->id_dv = $dichvu;
            $model->id_Pro_dv = $post['id_Pro_dv'];
            $model->price = $post['price'];
            $model->quantity = $post['quantity'];
            $model->suffixes = $post['suffixes'];
            if($model->save()) {
                // $html = '<td>'.$model->danhsachdv->tendv.'</td>';
                return json_encode(array(
                    // 'html' => $html,
                    'id' => $id,
                    'id_Pro_dv' => $model->danhsachdv->tendv,
                    'price' => Yii::$app->formatter->asDecimal($model->price,0),
                    'quantity' => $model->quantity,
                    'suffixes' => $model->suffixes,
                ));
            }
        }

        // return json_encode(array(
        //     'id' => $id,
        //     'id_Pro_dv' => $model->id_Pro_dv,
        //     'price' => $model->price,
        //     'quantity' => $model->quantity,
        //     'suffixes' => $model->suffixes,
        // ));
        return json_encode(array( 'id'=>$id, 'id_Pro_dv' => $model->id_Pro_dv));
    }

    // Hàm xóa chi tiết dịch vụ
    public function actionXoachitiet()
    {
        if ($post = Yii::$app->request->post()) {
            $id = $post['id'];
            $model = KhChitietDv::findOne($id);
            if($model->delete()) {
                return json_encode(array(
                    'id' => $id,
                ));
            }
        }

        return json_encode(array( 'id'=>$post['id']));
    }

    public function actionUpdate($id)
    {
        // $this->layout = 'mainup';
        $model = $this->findModel($id);
        $dichvu = new KhXe();
        $dataXeKH = [$model->id_xe => $dichvu->getTTXe($model->id_xe)];

        $adddv = new Adddv();
        $manager = Yii::$app->user->identity->manager;
        // if($model->user_add != Yii::$app->user->id && $manager != 1){
        //     throw new NotFoundHttpException('Khách hàng này không phải bạn thêm, nên không thể sửa !');
        // }
        // dbg(json_decode(getUser()->cuahang_id));
        if(!in_array($model->cuahang_id, json_decode(getUser()->cuahang_id)) && $manager != 1){
            throw new NotFoundHttpException('Khách hàng này không phải bạn thêm, nên không thể sửa !');
        }

        if($model->status == 1 && getUser()->manager != 1){
            throw new HttpException(403,'Hóa đơn này tạo ngày '.Yii::$app->formatter->asDate($model->day, 'dd-M-Y').' đã xuất bạn không thể sửa !');
        }

        $khachhang = new KhachHang();
        $dataKhachhang = $khachhang->getOneKH($model->id_kh);
        

        $cache = Yii::$app->cache;
        if ($cache->get('cache_app_dichvukh') === false) {
            $dichvu = new KhachhangDichvuList();
            $dataDichvu = $dichvu->getAllDichvu();
            Yii::$app->cache->set('cache_app_dichvukh', $dataDichvu, 28800);//set cache trong 8 tieng
            unset($dataDichvu);
        }

        if(Yii::$app->user->identity->view_cuahang == 1 ){
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
    

    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }



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

       $total_money =0;
       foreach ($modelsKhChitietDv as $value) {
        $total_money += $value->price*$value->quantity;
    }

    $model->total_money = $total_money;

    if ($post['KhDichvu']['tienthu_kh'] !='' || $post['KhDichvu']['tienthu_kh'] == 0) 
    {
        $model->tienthu_kh = $total_money;
    }
    $chitiet = (isset($post['themchitiet'])) ? $post['themchitiet'] : false;

    if (isset($chitiet['price'])) {
        $model->total_money = $model->tienthu_kh = $total_money + array_sum($chitiet['price']);
    }

    if ($model->save(false)) {
        if (isset($chitiet['name'])) {
            foreach ($chitiet['name'] as $key => $value) {
                $chitietdv = new KhChitietDv();
                $chitietdv->id_dv = $model->iddv;
                $chitietdv->id_Pro_dv = $value;
                $chitietdv->suffixes = $chitiet['suffixes'][$key];
                $chitietdv->price = str_replace('.','',$chitiet['price'][$key]);
                $chitietdv->quantity = $chitiet['quantity'][$key];
                // KIỂM TRA NẾU LƯU CHI TIẾT THÀNH CÔNG THÌ TRỪ VÀO BẢNG TỒN KHO ĐỂ KIỂM TRA CHO NHỮNG LẦN SAU
                if($chitietdv->save()){
                    // pr($model->cuahang_id);
                    // pr($chitietdv->danhsachdv->madichvu);
                    // dbg($chitietdv->danhsachdv);
                    $tonkho = SanphamThongke::findOne(['masp'=>$chitietdv->danhsachdv->madichvu,'cuahang_id'=>$model->cuahang_id]);
                    if ($tonkho) {
                        $tonkho->slxuat = $tonkho->oldAttributes['slxuat'] + $chitietdv->quantity; 
                        $tonkho->slton = $tonkho->oldAttributes['slton'] - $chitietdv->quantity; 
                            // dbg($tonkho->oldAttributes['slxuat']);
                            // dbg($tonkho->oldAttributes);
                        $tonkho->save();
                    }
                }else {
                    dbg($chitietdv->errors);
                }
                // dbg($chitietdv);
            }
        }

        return $this->redirect(['view', 'id' => $model->iddv]);

    }else {
        dbg($model->errors);
    }


}

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->iddv]);
        // }

// dbg($modelsKhChitietDv);

    return $this->render('update', [
        'model' => $model,
            // 'chitiet' => $chitiet,
        'dataCuahang' => $dataCuahang,
        'dataKhachhang' => $dataKhachhang,
        'dataXeKH' => $dataXeKH,
        'dataEmployee' => $dataEmployee,
        'adddv' => $adddv,
        'datasophieu' => $datasophieu,
        'modelsKhChitietDv' =>  $modelsKhChitietDv
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
