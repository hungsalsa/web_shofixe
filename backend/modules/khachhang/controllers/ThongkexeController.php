<?php

namespace backend\modules\khachhang\controllers;


use Yii;
use yii\web\Controller;
use backend\modules\khachhang\models\ThongkexeSearch;
use backend\modules\khachhang\models\KhXe;
use backend\modules\khachhang\models\KhachHang;
use backend\modules\khachhang\models\KhDichvu;
use backend\modules\khachhang\models\KhChitietDv;
use backend\modules\khachhang\models\KhachhangDichvuList;
use backend\modules\quantri\models\Motorbike;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

class ThongkexeController extends \yii\web\Controller
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
                    'layxekhach' => ['post'],
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
    
    public function actionResetcache()
    {
        // echo 60*60*8;die;
        $cache = \Yii::$app->cache;;
        if ($cache->get('Cache_dataKhachhang') == true)
        {
            $cache->delete('Cache_dataKhachhang');
        }
        $khachhang = new KhachHang();
        $dataKhachhang = $khachhang->AllKhachhang();
        $cache->set('Cache_dataKhachhang', $dataKhachhang, 28800);//set cache trong 8 tieng
        return $this->redirect((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
    }


    public function actionLayxekhach()
    {
        if ($post = Yii::$app->request->post()) {
            $id_kh = $post['id_kh'];

            $xe = new KhXe();
            $out = $xe->Laydanhsachxe($id_kh);

            if (isset($post['ThongkexeSearch']['xe_kh'])) {
             $xe_kh = $post['ThongkexeSearch']['xe_kh']; 
         }

            $result = [
                'id_kh' => $id_kh,
                'xe_kh' => (isset($xe_kh)) ? $xe_kh : null,
                'dataxekhachang' => $out,
            ];
            return json_encode($result);
        }

        $result = [
            'id_kh' => '',
        ];
            // return json_encode($result);
        return json_encode($result);
    }

    public function actionIndex()
    {
    	$searchModel = new ThongkexeSearch();

        // echo 60*60*8;die;
        $cache = Yii::$app->cache;
        $khachhang = new KhachHang();
        if ($cache->get('Cache_dataKhachhang') == false)
        {
            $dataKhachhang = $khachhang->AllKhachhang();
            $cache->set('Cache_dataKhachhang', $dataKhachhang, 28800);//set cache trong 8 tieng
        }

        $danhsachXe=[];
        $listDichvu=[];
        
        $data = [];
        $post = Yii::$app->request->post();
    	if (isset($post) && $searchModel->load($post))
        {
             $idKH = $post['ThongkexeSearch']['khachhang']; 
             // dbg($post);
             $xe_kh ='';
             if (isset($post['ThongkexeSearch']['xe_kh'])) {
                 $xe_kh = $post['ThongkexeSearch']['xe_kh']; 
             }
            // Lấy id của khách hàng, lấy thông tin khách hàng
            $data['khachhang'] = $khachhang->finOneKH($idKH);
            $dichvu = new KhDichvu();
            
            $data['dichvu'] = $dichvu->getAllDichvu($idKH,$xe_kh);
            // dbg($data['dichvu']);
            // dbg($data['dichvu']);
            if ($xe_kh != '') {
                $data['khachhang']['xeKH']=[ $xe_kh=> KhXe::find()->andWhere(['id'=>$xe_kh])->asArray()->one()];
            }

            $chitiet = new KhChitietDv();
            $data['tongtien'] = $chitiet->getTotalMoney($idKH);

            $motor = new Motorbike();
            $danhsachXe = $motor->getAllMotorbike();

            $dsdv = new KhachhangDichvuList;
            $listDichvu = ArrayHelper::map($dsdv->ConcatAllDichvu(),'id','TTDV');


          if (!$data['tongtien']) {
            Yii::$app->session->setFlash('messeage','Khách hàng '.$data['khachhang']['name'].'-'.$data['khachhang']['phone'].' chưa có dịch vụ nào');
          }else {
            Yii::$app->session->setFlash('messeage','Khách hàng '.$data['khachhang']['name'].'-'.$data['khachhang']['phone'].' đã '.count($data['dichvu']).' lần sử dụng dịch vụ, với tổng số tiền: '.Yii::$app->formatter->asInteger($data['tongtien']*1000)).' VNĐ';
          }
          
        }

        return $this->render('index',[
        	'searchModel' => $searchModel,
        	'data' => $data,
        	'danhsachXe' => $danhsachXe,
        	'listDichvu' => $listDichvu,
        ]);
    }

    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $xe = new KhXe();
                $out = $xe->getSubkhachhang($cat_id); 
                
                return json_encode(['output'=>$out, 'selected'=>'...']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

}
