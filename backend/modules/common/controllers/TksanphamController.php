<?php
namespace backend\modules\common\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\sanpham\models\Thongkesp;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\common\models\SanphamThongke;
use backend\modules\common\models\SanphamThongkeSearch;
use backend\modules\common\models\ThongkeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quantri\models\CuaHang;
use yii\filters\AccessControl;
class TksanphamController extends \yii\web\Controller
{
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

    public function actionIndex()
    {
        $searchModel = new ThongkeSearch();
        if (getUser()->manager != 1) {
            $cuahang_id = json_decode(getUser()->cuahang_id);
        }else {
            $cuahang_id = [1,2,3,4,5];
            // $cuahang_id = json_decode(getUser()->cuahang_id);
        }
        if (count($cuahang_id) == 1) {
            $searchModel->cuahang_id = $cuahang_id[0];
        }
        $search['cuahang'] = $search['cuahang_query'] = ArrayHelper::map(CuaHang::findAll($cuahang_id),'id','name');

        $cate= new ProductCate();
        $search['category'] = $search['category_query'] = $cate->getCategoryParent();
        

        $model= new SanphamThongke();
        $cache = Yii::$app->cache;
        if ($cache->get('cache_app_sanpham_ton') === false) {
            $product = $model->getThongke($cuahang_id);
            Yii::$app->cache->set('cache_app_sanpham_ton', $product, 28800);
        }
        // Lấy tất cả sản phẩm để ra search
        $dataProduct =  $model->getProduct([2]);
        $dataProductquery = array_keys($dataProduct);
        
        if ($searchModel->load($post = Yii::$app->request->post()))
        {
            $cuahang = $post['ThongkeSearch']['cuahang_id'];
            $cate_id = $post['ThongkeSearch']['cate_id'];
            $proId = $post['ThongkeSearch']['proId'];

            if (!empty($cuahang)) {
                unset($search['cuahang_query']);
                foreach ($cuahang as $value) {
                    $search['cuahang_query'][$value] = $search['cuahang'][$value];
                }
                $dataProduct =  $model->getProduct($cuahang);
                $dataProductquery = array_keys($dataProduct);
            }
            if (!empty($cate_id)) 
            {
                unset($search['category_query']);
                $search['category_query'] = $this->getCategoryQuery($cate_id,$search['category']);
            }

            if (!empty($proId)) {
                $product = new Product();
                $cate_id = $product->getAllCateId(array_keys($search['cuahang_query']),$proId);
                if (empty($cate_id)) {
                    unset($search['category_query']);
                }
                $category_query = $this->getCategoryQuery($cate_id,$search['category']);
                $search['category_query'] = array_intersect_assoc($search['category_query'],$category_query);
                
                $dataProductquery = $proId;
            }

        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProductquery' => $dataProductquery,
            'search' => $search,
            'dataProduct' => $dataProduct,
        ]);
    }

    private function getCategoryQuery($cate_id,$categoryArray)
    {
        $cate= new ProductCate();

        $query = [];
        foreach ($cate_id as  $value) 
        {
            $listCate = $cate->getAllIDCate($value);
            foreach ($listCate as $idchild) {
                if (isset($query) && array_key_exists($idchild, $query)) {
                    continue;
                }
                $query[$idchild] =  $categoryArray[$idchild];
            }
        }
        return $query;
    }

    public function actionTimkiem()
    {
        $searchModel = new ThongkeSearch();

        if (getUser()->manager != 1) {
            $cuahang_id = json_decode(getUser()->cuahang_id);
        }else {
            $cuahang_id = [1,2,3,4];
        }

        $model= new Thongkesp();
        // echo '<pre>';print_r($dataCuahang);die;

        $search['cuahang'] = $search['cuahang_query'] = ArrayHelper::map(CuaHang::findAll($cuahang_id),'id','name');
        $data = $model->getThongKe($search['cuahang_query']);

        if ($searchModel->load($post = Yii::$app->request->post()))
        {

            echo '<pre>';print_r($post);
            die;

        }

        return $this->render('capnhat', [
            'searchModel' => $searchModel,
            'data' => $data,
            'search' => $search,
        ]);
    }

}
