<?php

namespace backend\modules\khachhang\controllers;

use yii\web\Controller;
use Yii;
use backend\modules\khachhang\models\InhdSearch;

use backend\modules\khachhang\models\KhXe;
use backend\modules\khachhang\models\KhachHang;
use backend\modules\khachhang\models\KhDichvu;
use backend\modules\khachhang\models\KhChitietDv;
use backend\modules\khachhang\models\KhachhangDichvuList;
use backend\modules\sanpham\models\Motorbike;
use backend\modules\sanpham\models\Product;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * Default controller for the `khachhang` module
 */
class DefaultController extends Controller
{
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'actions' => ['login', 'error'],
    //                     'allow' => true,
    //                 ],
    //                 [
    //                     // 'actions' => ['logout', 'index'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                     'matchCallback'=> function ($rule ,$action)
    //                     {
    //                         $control = Yii::$app->controller->id;
    //                         $action = Yii::$app->controller->action->id;
    //                         $module = Yii::$app->controller->module->id;

    //                         $role = $module.'/'.$control.'/'.$action;
    //                         if (Yii::$app->user->can($role)) {
    //                             return true;
    //                         }else {
    //                           throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
    //                         }
    //                     }
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //                 'delete' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    // /**
    //  * {@inheritdoc}
    //  */
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

    	$searchModel = new InhdSearch();
    	// $xe_khachhang = new KhXe();
        $khachhang = new KhachHang();
        $dataKhachhang = $khachhang->AllKhachhang();

        $dichvu = new KhDichvu();
        // $ngayDichvu = $dichvu->getAllDate();

        // $dsdv = new KhachhangDichvuList;
        // $listDichvu = ArrayHelper::map($dsdv->ConcatAllProduct(),'id','TTDV');
        
        // $xekh = new KhXe();
    	// $danhsachXe = ArrayHelper::map($xekh->getXeKH(),'maxe','TTXEKH');
        $data = $result = [];
        // $khachhang = $xe_kh = $ngay_in ='';
    	if ($searchModel->load($post = Yii::$app->request->post()))
        {

            $data = $dichvu->getDichvuKH($post['InhdSearch']['khachhang'],$post['InhdSearch']['xe_kh'],$post['InhdSearch']['ngay_in']);
    	// echo '<pre>';print_r($data['dichvu']);die;
        }

        return $this->render('index',[
        	'searchModel' => $searchModel,
        	'dataKhachhang' => $dataKhachhang,
            'data' => $data,
        	'result' => $result,
        	// 'danhsachXe' => $danhsachXe,
        	// 'listDichvu' => $listDichvu,
        	// 'ngayDichvu' => $ngayDichvu,
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

    public function actionProd() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
             // $data = self::getProdList($cat_id, $subcat_id);
             $dichvu = new KhDichvu();
            $data = $dichvu->getNgayKH($cat_id, $subcat_id); 
             // echo '<pre>';print_r($data);die;
            /**
             * the getProdList function will query the database based on the
             * cat_id and sub_cat_id and return an array like below:
             *  [
             *      'out'=>[
             *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
             *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
             *       ],
             *       'selected'=>'<prod-id-1>'
             *  ]
             */

                return json_encode(['output'=>$data['out'], 'selected'=>$data['selected']]);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    public function actionDichvukhachhang()
    {
        $dichvu = new KhachhangDichvuList();
        $dataDichvu = $dichvu->AllDichvu();
        $dataDichvu2 = $dichvu->getAllDichvu();

        $product = new Product();
        $dataPro = $product->getConcatAllProduct();
        $dataPro = ArrayHelper::map($dataPro,'id','proName');
        
        $result = $dataPro + $dataDichvu;
        pr($result);
        dbg($dataDichvu2);
        dbg($dataPro);
    }
   
}
