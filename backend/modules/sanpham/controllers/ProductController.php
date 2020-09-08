<?php

namespace backend\modules\sanpham\controllers;

use Yii;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductSearch;
use backend\modules\sanpham\models\ProductSuaSearch;
use backend\modules\sanpham\models\ProductDiarySearch;
use backend\modules\sanpham\models\ProductMotorbike;
use backend\modules\sanpham\models\ProductDiary;
use backend\modules\quantri\models\Unit;
use backend\modules\quantri\models\Motorbike;
use backend\modules\quantri\models\CuaHang;
use backend\modules\sanpham\models\Manufacture;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\sanpham\models\Location;
use backend\modules\khachhang\models\KhachhangDichvuList;
use backend\modules\chi\models\ChiKhoanchi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\helpers\Json;
use yii\base\InvalidConfigException;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'httpCache' => [
                'class' => \yii\filters\HttpCache::className(),
                'only' => ['list'],
                'lastModified' => function ($action, $params) {
                    $q = new Query();
                    return strtotime($q->from('users')->max('updated_timestamp'));
                },
            // 'etagSeed' => function ($action, $params) {
                // return // generate etag seed here
            //}
            ],
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
                    'quickchange' => ['post'],
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

    public function init()
    {
        $module = Yii::$app->getModule('gridview');
        if ($module == null || !$module instanceof \kartik\grid\Module) {
            throw new InvalidConfigException('The "gridview" module MUST be setup in your Yii configuration file and assigned to "\kartik\grid\Module" class.');
        }
        parent:: init();
    }
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionDeleteMultiple()
    {
        $pk = Yii::$app->request->post('keylist'); // Array or selected records primary keys
        // echo '<pre>';print_r($pk);die;
        // Preventing extra unnecessary query
        $idList = [];
        foreach ($pk as $key => $value) 
        {
            $idList[] = $value;
            // $query = Yii::$app->db->createCommand($sql)->execute();
        }

        if (!$idList) {
            return;
        }else {
            Product::deleteAll(['id' => $idList]);
        }
        return $this->redirect(['index']);

    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'created_at' => SORT_DESC];

        $location = new Location();
        $data['location'] = $location->getAllLocation();
        $data['status'] = [0=>' Hidden ',1=>' Active '];

        $id = json_decode($this->login()->cuahang_id);
        if ($this->login()->manager != 1) {
            $dataProvider->query->andWhere(['in', 'pro.cuahang_id', $id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
        ]);
    }
    public function actionSuanhanh()
    {
        $searchModel = new ProductSuaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'created_at' => SORT_DESC];
        // $dataProvider->query->where('employee.role <> \'regular\'');
        // $dataProvider->query->andWhere(['in', 'cuahang_id', [2]]);

        $location = new Location();
        $data['location'] = $location->getAllLocation();
        $data['status'] = [0=>' Hidden ',1=>' Active '];
        $motor = new Motorbike();
        $data['bike_id'] = $motor->getAllMotorbike();;


        return $this->render('suanhanh', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
        ]);
    }

    public function actionUpdateproduct()
    {
        if ($post = Yii::$app->request->post()) {
            $products = Product::findAll(['cuahang_id'=>2,'status'=>true]);
            $cuahang_post = $post['cuahang_id'];
            foreach ($products as $product) {
                $product_query = Product::findOne(['cuahang_id'=>$cuahang_post,'status'=>true,'idPro'=>$product->idPro]);

                // if ($product->idPro != '071924149762') {
                //     continue;
                // }else {
                    
                // }
                // dbg($product);
                if ($product_query) {
                    // NẾU TỒN TẠI PHỤ TÙNG
                    $checkchange = false;

                    if ($product->proName != $product_query->proName) {
                        $product_query->proName = $product->proName;
                        $checkchange = true;
                    }
                    if ($product->price != $product_query->price) {
                        $product_query->price = $product->price;
                        $checkchange = true;
                    }
                    if ($product->price_sale != $product_query->price_sale) {
                        $product_query->price_sale = $product->price_sale;
                        $checkchange = true;
                    }
                    if ($product->import_price != $product_query->import_price) {
                        $product_query->import_price = $product->import_price;
                        $checkchange = true;
                    }
                    if ($product->cong_dv != $product_query->cong_dv) {
                        $product_query->cong_dv = $product->cong_dv;
                        $checkchange = true;
                    }
                    if ($product->unit != $product_query->unit) {
                        $product_query->unit = $product->unit;
                        $checkchange = true;
                    }
                    if ($product->bike_id != $product_query->bike_id) {
                        $product_query->bike_id = $product->bike_id;
                        $checkchange = true;
                    }
                    if ($product->manu_id != $product_query->manu_id) {
                        $product_query->manu_id = $product->manu_id;
                        $checkchange = true;
                    }
                    if ($product->cate_id != $product_query->cate_id) {
                        $product_query->cate_id = $product->cate_id;
                        $checkchange = true;
                    }
                    if ($product->status != $product_query->status) {
                        $product_query->status = $product->status;
                        $checkchange = true;
                    }

                    if ($checkchange == true) {
                        $product_query->updated_at = time();
                        $product_query->user_add = getUser()->id;
                        $product_query->save();
                        // pr($product_query->errors);
                    }
                } else {
// dbg($product);
                    // NẾU KO TỒN TẠI PHỤ TÙNG
                    $newPro = new Product();

                    $newPro->idPro = $product->idPro;
                    $newPro->cuahang_id = $cuahang_post;
                    $newPro->proName = $product->proName;
                    $newPro->quantity = $product->quantity;
                    $newPro->import_price = $product->import_price;
                    $newPro->price = $product->price;
                    $newPro->price_sale = $product->price_sale;
                    $newPro->cong_dv = $product->cong_dv;
                    $newPro->note = $product->note;
                    $newPro->location = $product->location;
                    $newPro->unit = $product->unit;
                    $newPro->bike_id = $product->bike_id;
                    $newPro->manu_id = $product->manu_id;
                    $newPro->cate_id = $product->cate_id;
                    $newPro->status = $product->status;

                    $newPro->created_at = time();
                    $newPro->updated_at = time();
                    $newPro->user_add = getUser()->id;

                    $newPro->save();
                    // pr($newPro->errors);
                }
// dbg($product);
                

                // CẬP NHẬT LẠI GIÁ DỊCH VỤ KHÁCH HÀNG
                $dichvu = KhachhangDichvuList::findOne(['madichvu'=>$product->idPro,'phutung'=>1]);
                if ($dichvu) {
                    // NẾU TỒN TẠI DỊCH VỤ
                    $checkchange = false;
// dbg($dichvu);
                    if ($product->proName != $dichvu->tendv) {
                        $dichvu->tendv = $product->proName;
                        $checkchange = true;
                    }
                    if ($product->price != $dichvu->price) {
                        $dichvu->price = $product->price;
                        $checkchange = true;
                    }
                    if ($product->price_sale != $dichvu->price_sale) {
                        $dichvu->price_sale = $product->price_sale;
                        $checkchange = true;
                    }
                    if ($product->bike_id != $dichvu->xe_sd) {
                        $dichvu->xe_sd = $product->bike_id;
                        $checkchange = true;
                    }

                    if ($checkchange == true) {
                        $dichvu->updated_at = time();
                        $dichvu->user_add = getUser()->id;
                        $dichvu->save();
                    }
                } else {
                    // NẾU KO TỒN TẠI DỊCH VỤ
                    $newDichvu = new KhachhangDichvuList();
                    $newDichvu->phutung = 1 ;
                    $newDichvu->madichvu = $product->idPro ;
                    $newDichvu->tendv = $product->proName ;
                    $newDichvu->price = $product->price ;
                    $newDichvu->price_sale = $product->price_sale ;
                    $newDichvu->xe_sd = $product->bike_id ;
                    $newDichvu->status = 1;

                    $newDichvu->updated_at = time();
                    $newDichvu->user_add = getUser()->id;
                    $newDichvu->save();
                }
                

                // dbg($dichvu);
            }
                return $this->redirect(['updateproduct']);
            dbg($cuahang_post);
            // pr($products);
        }
        return $this->render('updateproduct', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            // 'data' => $data,
        ]);
    }
    public function actionQuickchange()
    {
            $post = Yii::$app->request->post();
            $id = $post['id'];
            $model = Product::findOne($id);
            $loginU = getUser()->id;
            if ( $loginU !=1 && $loginU != 8 ) {
                $result = ["postValue" => getUser()->username." không có quyền sửa"];
                return json_encode($result);
            }

            $field = $post['field'];
            $value_post = $post['value_post'];
            $model->$field = $value_post;
            $result = [
                'id' => $id,
                'value_post' => $value_post,
                'proname' => $model->proName,
                'field' => $post['field'],
            ];
            if(getUser()->manager==1){
                $result = array_merge($result,["postValue" => $value_post]);
                if ($field == 'price' ||$field == 'price_sale') {
                    $result = array_merge($result,["postValue" => Yii::$app->formatter->asDecimal($value_post,0)]);
                }

                if ($field == 'status') {
                    $data['status'] = [0=>' Hidden ',1=>' Active '];
                    $result = array_merge($result,["postValue" => $data['status'][$value_post]]);
                }

                if ($field == 'location') {
                    $newLoca = new Location();
                    $result = array_merge($result,["postValue" => $newLoca->getName($value_post)]);
                }
                if ($field == 'bike_id') {
                    $bike = new Motorbike();
                    $result = array_merge($result,["postValue" => $bike->ReturnBikename($value_post)]);
                    $model->$field = json_encode($value_post);
                }

                
                if ($field == 'proName') {
                    $model->$field = ucfirst(trim($value_post));
                }
                $model->updated_at = time();
                $model->user_add = getUser()->id;

                if($model->save()) {
                    // CẬP NHẬT SẢN PHẨM CỬA HÀNG KHÁC
                    if ($field != 'location') {
                        $products = Product::find()
                        ->where(['idPro'=>$model->idPro])
                        ->andWhere(['not in','cuahang_id',2])
                        ->all();
                        if ($products) {
                            foreach ($products as $product) {
                                $product->$field = $model->$field;
                                $product->save();
                            }
                        }
                    }


                    if ($field == 'guarantee' || $field == 'price' || $field == 'price_sale' || $field == 'status' || $field == 'proName') {
                        // THAY ĐỔI TRONG DỊCH VỤ KHÁCH HÀNG
                        $dichvu = KhachhangDichvuList::findOne(['madichvu'=>$model->idPro,'phutung'=>1]);
                        if ($dichvu) {
                            if ($field == 'proName') {
                                $dichvu->tendv = $model->$field;
                                /*THAY ĐỔI TRONG KHOẢN CHI*/
                                $khoanchi = ChiKhoanchi::findOne(['makhoanchi'=>$model->idPro,'loaichi_id'=>1]);
                                if ($khoanchi) {
                                    $khoanchi->name = $model->$field;
                                    $khoanchi->save();
                                }
                            }else {
                                $dichvu->$field = $model->$field;
                            }
                            $dichvu->save();
                        // $result = array_merge($result,["postValue" => $dichvu->$field]);
                        }
                        // dbg($khoanchi);
                    }
                    return json_encode($result);
                }else {
                    $erros = $model->errors;
                    $result = array_merge($result,["error" => $erros]);
                }
            }else {
                if ($field == 'location') {
                    $model->$field = $value_post;
                    $model->updated_at = time();
                    $model->user_add = getUser()->id;
                    $newLoca = new Location();
                    $result = array_merge($result,["postValue" => $newLoca->getName($value_post)]);

                    if($model->save()) {

                        return json_encode($result);
                    }
                }else {
                    $result = array_merge($result,["postValue" => "Bạn không có quyền sửa"]);
                }
            }
            
            

            return json_encode($result);
        // }

        // return json_encode(array( 'id'=>'chua co gi','abc'=> $_POST['value_post']));
    }

    public function actionEdit()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $id = json_decode($this->login()->cuahang_id);
        if ($this->login()->manager != 1) {
            $dataProvider->query->andWhere(['in', 'pro.cuahang_id', $id]);
        }

        $model = new Manufacture();
        $data['manufacture'] = $model->getAllManufacture();

        $model = new ProductCate();
        $data['category'] = $model->getCategoryParent();

        if (Yii::$app->request->post('hasEditable') && $editableKey = Yii::$app->request->post('editableKey')) 
        {
            if (getUser()->manager == true) {
                // $editableKey = Yii::$app->request->post('editableKey');
                $editableIndex = Yii::$app->request->post('editableIndex');
                $editableAttribute = Yii::$app->request->post('editableAttribute'); // DDaay la truong thay doi
                $post_attribute = $_POST["Product"][$editableIndex][$editableAttribute];
                // print_r($customerItemsId);die();

                $model = Product::findOne($editableKey);
                $out = Json::encode(['output'=>'', 'message'=>'']);
                $post = [];
                $posted = current($_POST['Product']);
                $post['Product'] = $posted;
                if ($model->load($post)) 
                {
                    $model->$editableAttribute=$post_attribute;
                    $model->updated_at=time();
                    $model->user_add = Yii::$app->user->identity->id;
                    $model->save();
                    $output = '';
                }
            } else {
                $output = 'Bạn ko thể sửa, liên hệ quản lý';
            }
             
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }

        return $this->render('edit', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function login()
    {
        if($user = Yii::$app->user->identity){
           return $user;
       }
       throw new NotFoundHttpException('Bạn chưa đăng nhập');
    }
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (!in_array($model->cuahang_id,json_decode($this->login()->cuahang_id))) {
            throw new HttpException(403, 'Bạn không có quyền vào đây, chưa chia sẻ quyền');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $productdiary = new ProductDiary();

        $user = Yii::$app->user->identity; 
        if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền xóa');
        }

        if($user->manager != 1 && $user->id != 2){
            throw new NotFoundHttpException('Bạn Không thể thêm sản phẩm');
        }

        $unit = new Unit();
        $dataUnit = $unit->getAllUnit();
        if(empty($dataUnit)){
            $dataUnit = array();
        }

        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        $manufacture = new Manufacture();
        $dataManu = $manufacture->getAllManufacture();
        if(empty($dataManu)){
            $dataManu = array();
        }

        $cate = new ProductCate();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = array();
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahang_ByUser();
        // if(empty($dataCuahang)){
        //     throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        // }
        unset($dataCuahang[1],$dataCuahang[3],$dataCuahang[4],$dataCuahang[5]);
        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cuahang_id = $key;
            }
        }

        $model->cuahang_id = 2;
        $model->status = 1;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            if($post['Product']['bike_id'] != ''){
                $model->bike_id = json_encode($post['Product']['bike_id']);
            }

            if($post['Product']['quantity'] == ''){
                $model->quantity = 0;
            }
            if($post['Product']['import_price'] == ''){
                $model->import_price = 0;
            }
            if($post['Product']['price'] == ''){
                $model->price = 0;
            }
            if($post['Product']['price_sale'] == ''){
                $model->price_sale = 0;
            }
            if($post['Product']['cong_dv'] == ''){
                $model->cong_dv = 0;
            }
            if($post['Product']['location'] == ''){
                $model->location = 1;
            }
            $model->idPro = strtoupper($post['Product']['idPro']);
            $model->proName = ucfirst(trim($post['Product']['proName']));

            $date = date('Y-m-d', time());
            if($model->save()){
                if (!empty($post['Product']['bike_id'])) {
                    foreach ($post['Product']['bike_id'] as $motor) {
                        $pro_motor = new ProductMotorbike();
                        $pro_motor->pro_id = $model->id;
                        $pro_motor->motor_id = $motor;
                        $pro_motor->save();
                    }
                }
                // Cập nhật nhật ký
                // $productdiary->status = 0;
                // $productdiary->addDiary($model->id,$model->quantity,0,$date,$model->quantity);
                    // var_dump($productdiary->errors);die;
                return $this->redirect(['create']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataUnit' => $dataUnit,
            'dataMotor' => $dataMotor,
            'dataManu' => $dataManu,
            'dataCate' => $dataCate,
            'dataCuahang' => $dataCuahang,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $productdiary = new ProductDiary();

        $user = Yii::$app->user->identity; 
        if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền xóa');
        }

        if($user->manager != 1 && $user->id != 2){
            throw new NotFoundHttpException('Bạn Không thể thêm sản phẩm');
        }

        $unit = new Unit();
        $dataUnit = $unit->getAllUnit();
        if(empty($dataUnit)){
            $dataUnit = array();
        }

        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        $manufacture = new Manufacture();
        $dataManu = $manufacture->getAllManufacture();
        if(empty($dataManu)){
            $dataManu = array();
        }

        $cate = new ProductCate();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = array();
        }

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getCuahang_ByUser();
        // if(empty($dataCuahang)){
        //     throw new NotFoundHttpException('Bạn không có đủ quyền vào cửa hàng , hãy liên hệ với admin để hỗ trợ bạn');
        // }
        // unset($dataCuahang[1],$dataCuahang[3],$dataCuahang[4],$dataCuahang[5]);
        if(count($dataCuahang) == 1){
            foreach ($dataCuahang as $key => $value) {
                $model->cuahang_id = $key;
            }
        }

        if($model->bike_id != ''){
            $model->bike_id = json_decode($model->bike_id);
        }
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            if($post['Product']['bike_id'] != ''){
                $model->bike_id = json_encode($post['Product']['bike_id']);
            }
            // $model->idPro = strtoupper($post['Product']['idPro']);
            // $model->proName = ucfirst(trim($post['Product']['proName']));

            if($post['Product']['quantity'] == ''){
                $model->quantity = 0;
            }
            if($post['Product']['import_price'] == ''){
                $model->import_price = 0;
            }
            if($post['Product']['price'] == ''){
                $model->price = 0;
            }
            if($post['Product']['price_sale'] == ''){
                $model->price_sale = 0;
            }
            if($post['Product']['cong_dv'] == ''){
                $model->cong_dv = 0;
            }

            $old_bike_del = $model->oldAttributes;
            $old_bike_del = json_decode($old_bike_del['bike_id']);
            $new_bike_add = $model->attributes;
            $new_bike_add = json_decode($new_bike_add['bike_id']);
            
            // Kiểm tra sự khác nhau của xe truyền vào, cập nhật vào bảng product_motorbike
                if (!empty(($new_bike_add)) && !empty(($old_bike_del))) {


                    if (!empty(array_diff ($new_bike_add,$old_bike_del)) || !empty(array_diff ($old_bike_del,$new_bike_add))) {
                // Lấy xe mới khác, rồi thêm vào bảng xe sử dụng sp
                        $add_bike = array_diff ($new_bike_add,$old_bike_del);
                        foreach ($add_bike as $value) {
                            $pro_motor = new ProductMotorbike();
                            $pro_motor->pro_id = $model->id;
                            $pro_motor->motor_id = $value;
                            $pro_motor->save();
                        }
                // Lấy xe cũ khác rồi xóa của bảng xe sử dụng
                        $del_bike = array_diff ($old_bike_del,$new_bike_add);
                        foreach ($del_bike as $value) {
                            $pro_motor = ProductMotorbike::findOne(['pro_id'=>$model->id,'motor_id'=>$value]);
                            $pro_motor->delete();
                        }
                    }
                }
                elseif(!empty(($new_bike_add)) && empty(($old_bike_del)))
                {
                    $new_bike_add = $model->attributes;
                    $new_bike_add = json_decode($new_bike_add['bike_id']);
                    foreach ($new_bike_add as $motor) {
                        if (!ProductMotorbike::findOne(['pro_id'=>$model->id,'motor_id'=>$motor])) {
                            $pro_motor = new ProductMotorbike();
                            $pro_motor->pro_id = $model->id;
                            $pro_motor->motor_id = $motor;
                            $pro_motor->save();
                        }
                    }
                }

                $date = date('Y-m-d', time());
                if($model->save()){
                // Cập nhật nhật ký
                // $productdiary->status = 0;
                    // $productdiary->addDiary($model->id,$model->quantity,0,$date,$model->quantity);
                    return $this->redirect(['index']);
                }
        }

        return $this->render('update', [
            'model' => $model,
            'dataUnit' => $dataUnit,
            'dataMotor' => $dataMotor,
            'dataManu' => $dataManu,
            'dataCate' => $dataCate,
            'dataCuahang' => $dataCuahang,
        ]);
    }

    /**
     * Deletes an existing Product model.
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

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
