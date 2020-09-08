<?php

namespace backend\modules\khachhang\controllers;


use Yii;
use yii\web\Controller;
use backend\modules\khachhang\models\ThongkeSearch;
use backend\modules\khachhang\models\KhXe;
use backend\modules\khachhang\models\KhachHang;
use backend\modules\khachhang\models\KhDichvu;
use backend\modules\khachhang\models\KhChitietDv;
use backend\modules\khachhang\models\KhachhangDichvuList;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class ThongkeController extends \yii\web\Controller
{
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
    
    public function actionIndex()
    {
    	$searchModel = new ThongkeSearch();
    	$khachhang = new KhXe();
        // $dataKhachhang = $khachhang->GetKH();
        $dataKhachhang = ArrayHelper::map($khachhang->GetKH(),'makhach','TTKH');

        $dsdv = new KhachhangDichvuList;
        $listDichvu = ArrayHelper::map($dsdv->ConcatAllProduct(),'id','TTDV');
        // $listDichvu = $dsdv->ConcatAllProduct();
        
        $data = [];
        $danhsachXe = [];
    	if ($searchModel->load($post = Yii::$app->request->post()))
        {
        	$xe = $post['ThongkeSearch']['khachhang'];
        	$idKH = KhXe::findOne($xe);
        	$idKH = $idKH->id_KH;
        	$data['khachhang'] = KhachHang::findOne($idKH);

        	$xekh = new KhXe();
        	// $danhsachXe = $xekh->getXeKH();
        	$danhsachXe = ArrayHelper::map($xekh->getXeKH(),'maxe','TTXEKH');

        	$dichvu = new KhDichvu();
        	$data['dichvu'] = $dichvu->getAllDichvu($idKH);
        	
        	$chitiet = new KhChitietDv();
        	$data['tongtien'] = $chitiet->getTotalMoney($idKH);

          if (!$data['tongtien']) {
            Yii::$app->session->setFlash('messeage','Khách hàng '.$data['khachhang']->name.'-'.$data['khachhang']->phone.' chưa có dịch vụ nào');
          }else {
            Yii::$app->session->setFlash('messeage','Khách hàng '.$data['khachhang']->name.'-'.$data['khachhang']->phone.' đã '.count($data['dichvu']).' lần sử dụng dịch vụ, với tổng số tiền: '.$data['tongtien']);
          }
          
    	// echo '<pre>';print_r($data['dichvu']);die;
        }

        return $this->render('index',[
        	'searchModel' => $searchModel,
        	'dataKhachhang' => $dataKhachhang,
        	'data' => $data,
        	'danhsachXe' => $danhsachXe,
        	'listDichvu' => $listDichvu,
        ]);
    }

}
