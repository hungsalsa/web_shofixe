<?php

namespace backend\modules\khachhang\controllers;

use Yii;
use backend\modules\khachhang\models\KhachhangDichvuList;
use backend\modules\khachhang\models\dichvu\GiaDv;
use backend\modules\khachhang\models\KhachhangDichvuListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use backend\modules\quantri\models\Motorbike;
use backend\modules\sanpham\models\Product;
use yii\web\HttpException;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/**
 * DanhsachdichvuController implements the CRUD actions for KhachhangDichvuList model.
 */
class DanhsachdichvuController extends Controller
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
     * {@inheritdoc}
     */
    public function init()
    {
        $module = Yii::$app->getModule('gridview');
        if ($module == null || !$module instanceof \kartik\grid\Module) {
            throw new InvalidConfigException('The "gridview" module MUST be setup in your Yii configuration file and assigned to "\kartik\grid\Module" class.');
        }
        parent:: init();
    }
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
     * Lists all KhachhangDichvuList models.
     * @return mixed
     */
    public function actionResetdichvu()
    {
        $cache = Yii::$app->cache;
        if ($cache->get('cache_app_dichvukh') == true) {
            $cache->delete('cache_app_dichvukh');
        }
        $dichvu = new KhachhangDichvuList();
        $dataDichvu = $dichvu->getAllDichvu();
        Yii::$app->cache->set('cache_app_dichvukh', $dataDichvu, 28800);//set cache trong 8 tieng
        // return $this->redirect(['/common/tksanpham']);
        return $this->redirect((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
    }
    public function actionIndex()
    {
        $searchModel = new KhachhangDichvuListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSuanhanh()
    {
        $data['status'] = [0 =>' Ẩn ',1 =>' Kích hoạt '];
        
        $searchModel = new KhachhangDichvuListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('suanhanh', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
        ]);
    }

    public function actionEdit()
    {
        $searchModel = new KhachhangDichvuListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->request->post('hasEditable') && Yii::$app->request->post('editableKey')) 
        {
            $editableKey = Yii::$app->request->post('editableKey');
            
            //  else {
            $model = KhachhangDichvuList::findOne($editableKey);
            if ($model->phutung == true || getUser()->manager != 1) {
                $output = 'Dịch vụ này là phụ tùng ko thể sửa hoặc bạn ko có quyền sửa';
            // $out = Json::encode(['output'=>$output, 'message'=>'']);
            } else {
                $editableIndex = Yii::$app->request->post('editableIndex');
                $editableAttribute = Yii::$app->request->post('editableAttribute');
                $madichvu = $_POST["KhachhangDichvuList"][$editableIndex][$editableAttribute];
            
                $checkPro = KhachhangDichvuList::findAll(['madichvu'=>$madichvu]);
                if (count($checkPro) >= 1) {
                    $output = 'Mã dịch vụ này đã có, chọn mã dịch vụ khác';
                }else {
                    // $out = Json::encode(['output'=>'', 'message'=>'']);
                    $post = [];
                    $posted = current($_POST['KhachhangDichvuList']);
                    $post['KhachhangDichvuList'] = $posted;
                    if ($model->load($post)) 
                    {
                        if ($editableAttribute == 'madichvu') {
                            $model->$editableAttribute= strtoupper($madichvu);
                        }else {
                            $model->$editableAttribute= ucfirst($madichvu);
                        }
                        $model->updated_at=time();
                        $model->user_add = Yii::$app->user->identity->id;
                        $model->save();
                        $output = '';
                    } 
                }
            }
            // }
            
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            
            echo $out;
            return;
        }
        return $this->render('edit', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleteMultiple()
    {
        $pk = Yii::$app->request->post('keylist'); // Array or selected records primary keys
        // echo '<pre>';print_r($pk);die;
        $idList = [];
        foreach ($pk as $key => $value) 
        {
            $idList[] = $value;
            // $query = Yii::$app->db->createCommand($sql)->execute();
        }

        if (!$idList) {
            return;
        }else {
            KhachhangDichvuList::deleteAll(['id' => $idList]);
        }
        return $this->redirect(['index']);

    }

    public function actionNhanban()
    {
        $model = new Product();
        $products =$model->allProducts();
        $model = new KhachhangDichvuList();
        if (Yii::$app->request->post('nhanban') == true) {
            $model->NhanbanPhutung($products);
            return $this->redirect(Yii::$app->homeUrl.'khachhang/danhsachdichvu');
        }
        // return $this->render('index');
        return $this->render('danhsach');
    }

    /**
     * Displays a single KhachhangDichvuList model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        // $data = KhachhangDichvuList::getPricService($id);
        // dbg($data);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new KhachhangDichvuList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KhachhangDichvuList();


        $model->status = true;
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;
        $user = Yii::$app->user->identity;
        // if ($user->manager == false) {
        //     throw new HttpException(403,'Tạm thời không thêm được dịch vụ, mọi người thêm nhiều dịch vụ linh tinh quá, mỗi người thêm 1 kiểu !');
        // }
        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
        	// echo '<pre>';print_r($post);die;
            $model->tendv = ucfirst($post['KhachhangDichvuList']['tendv']);
            if ($post['KhachhangDichvuList']['madichvu'] == '') {
                $model->madichvu = '-' ;
            }else {
            	$model->madichvu = strtoupper('dv'.$post['KhachhangDichvuList']['madichvu']);
            }
            
            if ($post['KhachhangDichvuList']['xe_sd'] != '') {
                $model->xe_sd = json_encode($post['KhachhangDichvuList']['xe_sd']) ;
            }
            if ($post['KhachhangDichvuList']['phutung'] != '') {
                $model->phutung = 0;
            }
            if($model->save()){
                Yii::$app->session->setFlash('messeage','Bạn đã thêm thành cồng dịch vụ : '.$model->tendv);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataMotor' => $dataMotor,
        ]);
    }

    /**
     * Updates an existing KhachhangDichvuList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->phutung == 1) {
            throw new HttpException(403,'Bạn không thể cập nhật dịch vụ là phụ tùng ! <br> Hãy nhân bản dịch vụ từ phụ tùng sẽ tự động thay đổi');
        }

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;
        $user = Yii::$app->user->identity;
        if ($user->manager != 1) {
            throw new HttpException(403,'Tạm thời không thêm được dịch vụ, mọi người thêm nhiều dịch vụ linh tinh quá, mỗi người thêm 1 kiểu !');
        }

        if ($model->xe_sd !='') {
            $model->xe_sd = json_decode($model->xe_sd);
        }

        $motor = new Motorbike();
        $dataMotor = $motor->getAllMotorbike();
        if(empty($dataMotor)){
            $dataMotor = array();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            $model->tendv = ucfirst($post['KhachhangDichvuList']['tendv']);
            if ($post['KhachhangDichvuList']['madichvu'] == '') {
                $model->madichvu = '-' ;
            }else {
            	$model->madichvu = strtoupper($post['KhachhangDichvuList']['madichvu']);
            }
            if ($post['KhachhangDichvuList']['xe_sd'] != '') {
                $model->xe_sd = json_encode($post['KhachhangDichvuList']['xe_sd']) ;
            }
            if($model->save()){
                Yii::$app->session->setFlash('messeage','Bạn đã sửa thành cồng dịch vụ : '.$model->tendv);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataMotor' => $dataMotor,
        ]);
    }

    /**
     * Deletes an existing KhachhangDichvuList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $user = Yii::$app->user->identity;
        // if($user->manager != 1){
        //     throw new NotFoundHttpException('Bạn không được xóa !');
        // }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KhachhangDichvuList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KhachhangDichvuList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KhachhangDichvuList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
