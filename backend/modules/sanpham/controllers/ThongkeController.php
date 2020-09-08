<?php
namespace backend\modules\sanpham\controllers;

use Yii;
use yii\web\NotAcceptableHttpException;
use backend\modules\sanpham\models\ThongkeSearch;
use backend\modules\sanpham\models\Inma;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\quantri\models\CuaHang;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class ThongkeController extends \yii\web\Controller
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
    public static function getDb() {
       return Yii::$app->get('db1'); // second database
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
      $user = Yii::$app->user->identity;

      $cate = new ProductCate();
      $dataCate = $cate->getCategoryParent();
      $dataCate_query = $cate->getCategoryParent();

      $cuahang = new CuaHang();
      $cuahang_query = $cuahangs = $cuahang->getCuahang_ByUser();
      if($user->manager != 1){
        $list = json_decode($user->cuahang_id);

        foreach ($cuahang as $key => $value) {
          if(!in_array($key, $list)){
            unset($cuahang[$key]);
          }
        }
      }

      $product = new Product();
      $dataPro = $product->getProductThongke();

      // echo '<pre>';print_r($dataPro);
      // die;
      if ($searchModel->load($post = Yii::$app->request->post()))
        {
          $cuahang_id = $post['ThongkeSearch']['cuahang_id'];
           $cate_id = $post['ThongkeSearch']['cate_id'];
           $sort = '';

          if($cate_id !='')
          {
            $idList = $cate->getAllIDCate($cate_id);
            foreach ($dataCate_query as $key => $value) {
              if(!in_array($key,$idList)){
                unset($dataCate_query[$key]);
              }
            }
          }

          if($cuahang_id !='')
          {
            $cuahang_query = [$cuahang_id=>$cuahangs[$cuahang_id]];
          }

          
          
          $dataPro = $product->getProductThongke($cuahang_id,$cate_id,$sort='');
          
        }


        return $this->render('index', [
            'dataCate' => $dataCate,
            'dataCate_query' => $dataCate_query,
            'cuahang' => $cuahangs,
            'cuahang_query' => $cuahang_query,
            'searchModel' => $searchModel,
            'data' => $dataPro,
        ]);
    }

}
