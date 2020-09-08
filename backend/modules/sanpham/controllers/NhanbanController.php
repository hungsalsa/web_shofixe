<?php
namespace backend\modules\sanpham\controllers;

use Yii;
use backend\modules\sanpham\models\Product;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\sanpham\models\SuamaSearch;
use backend\modules\sanpham\models\search\NhanbanSearch;
use backend\modules\quantri\models\CuaHang;
use backend\modules\chi\models\ChiKhoanchi;
use backend\modules\khachhang\models\KhachhangDichvuList;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\modules\common\models\SanphamThongke;
use backend\modules\common\models\Thongkesp;
class NhanbanController extends \yii\web\Controller
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
            // 'matchCallback'=> function ($rule ,$action)
            // {
            //   $control = Yii::$app->controller->id;
            //   $action = Yii::$app->controller->action->id;
            //   $module = Yii::$app->controller->module->id;

            //   $role = $module.'/'.$control.'/'.$action;
            //   if (Yii::$app->user->can($role)) {
            //     return true;
            //   }else {
            //     throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
            //   }
            // }
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'logout' => ['post'],
          'delete' => ['post'],
          // 'index' => ['post'],
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
      $id = '';
      if ($post = Yii::$app->request->post()) {
        echo $id = $post['cuahang_id'];
      }
      $data = Product::findAll(['cuahang_id'=>2]);

      $cuahang = new CuaHang();
      $cuahang = $cuahang->CuahangThongke();
      unset($cuahang[2]);
      $dataCuahang = $cuahang;
        
      if ($id != '') {
       foreach ($data as $value) {
        $model = Product::findOne(['idPro'=>$value->idPro,'cuahang_id'=>$id]);

        if ($model) {
          if ($value->proName != $model->proName) {
            $model->proName = $value->proName;
          }

          if ($value->price != $model->price) {
            $model->price = $value->price;
          }

          if ($value->price_sale != $model->price_sale) {
            $model->price_sale = $value->price_sale;
          }
          $model->save();
        }else {
         $pronew = new Product();
         $pronew->idPro = $value->idPro;
         $pronew->cuahang_id = $id;
         $pronew->proName = $value->proName;
         $pronew->price = $value->price;
         $pronew->unit = $value->unit;
         $pronew->quantity = $value->quantity;
         $pronew->bike_id = $value->bike_id;
         $pronew->manu_id = $value->manu_id;
         $pronew->cate_id = $value->cate_id;
         $pronew->status = $value->status;
         $pronew->created_at = time();
         $pronew->updated_at = time();
         $pronew->user_add = $value->user_add;
         $pronew->save();
          // print_r($pronew->errors);
        // }
      }
    }
  }

    return $this->render('index',[
      'data'=>$data,
      'dataCuahang'=>$dataCuahang,
    ]);
  }

  public function actionSuama() {
      $searchModel = new SuamaSearch();
      $data = [];

      if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
          Yii::$app->response->format = 'json';
          return ActiveForm::validate($model);
      }

      if ($post = Yii::$app->request->post()) {
          
          $code = $post['SuamaSearch'];
          $data['products'] = Product::findAll(['idPro'=>trim($code['matim'])]);
          
          $data['services'] = KhachhangDichvuList::findOne(['madichvu'=>trim($code['matim'])]);

          $data['khoanchi'] = ChiKhoanchi::findOne(['makhoanchi'=>trim($code['matim'])]);

          if (isset($post['replace']) && trim($code['masua']) != '' && trim($code['masua']) != trim($code['matim'])) {

            // Sửa mã products
            if (!empty($data['products'])) {
              foreach ($data['products'] as $value) {
                $value->idPro = strtoupper(trim($code['masua']));
                $value->save();
              }
            $data['products'] = Product::findAll(['idPro'=>trim($code['masua'])]);
            }

            // Sửa mã services
            if (!empty($data['services'])){
                $xe_sd = (isset($data['products'][0]['bike_id']) && $data['products'][0]['bike_id'] != '') ? $data['products'][0]['bike_id'] : '0';
              $data['services']->madichvu = strtoupper(trim($code['masua']));
              $data['services']->xe_sd = $xe_sd;
              $data['services']->save();

              $data['services'] = KhachhangDichvuList::findOne(['madichvu'=>trim($code['masua'])]);
            }

            // Sửa mã khoản chi
            if (!empty($data['khoanchi'])){
              $data['khoanchi']->makhoanchi = strtoupper(trim($code['masua']));
              $data['khoanchi']->save();

              $data['khoanchi'] = ChiKhoanchi::findOne(['makhoanchi'=>trim($code['masua'])]);
            }

          }

          if (isset($post['replace']) && trim($code['masua']) == '') {
              $data['error'] = 'Mã thay thế của bạn rỗng, không thể thay thế';
          }
          if (isset($post['replace']) && trim($code['masua']) == trim($code['matim'])) {
              $data['error'] = 'Mã thay thế của bạn giống mã tìm kiếm, không cần thay thế';
          }

          // dbg($post);
      }

          // dbg($data);
      return $this->render('suama', [
          'data' => $data,
          'searchModel' => $searchModel,
      ]);

  }

  public function actionKhac()
  {
    $searchModel = new NhanbanSearch();
    // $cuahang_id = json_decode(getUser()->cuahang_id);
    $data['cuahang'] = ArrayHelper::map(CuaHang::findAll([6,7]),'id','name');
// dbg($data['cuahang']);
    $cate= new ProductCate();
    $data['category'] = $cate->getCategoryParent();

    if ($post = Yii::$app->request->post()) {
      $query = $post['NhanbanSearch'];
// dbg($post);
      $model= new Thongkesp();
      $datathongke = $model->getThongKe($query['cuahang'],$query['danhmuc']);
dbg($datathongke);
      if ($post['replace']) {
        
        
        foreach ($datathongke as $value) {

          $sanpham = SanphamThongke::findOne(['masp'=>$value['idPro'],'cuahang_id'=>$value['cuahang_id']]);
          if ($sanpham) {
            
            $sanpham->cate_id = (int)$value['cate_id'];
            
            $sanpham->sldauky = (int)$value['sldauky'];
            $sanpham->tiendauky = (int)$value['tiendk'];

            $sanpham->slnhap = (int)$value['tongslnhap'];
            $sanpham->tiennhap = (int)$value['tongtiennhap'];

            $sanpham->slxuat = (int)$value['tongslKH'];
            $sanpham->tienxuat =(int)$value['tongtienKH'];

            $sanpham->slxuatnb = (int)$value['tongslXuatNB'];
            $sanpham->slnhapnb = (int)$value['tongslNhapNB'];


            $sanpham->slton = (int)$value['sldauky'] + ((int)$value['tongslnhap'] + (int)$value['tongslNhapNB']) - (int)$value['tongslKH'] - (int)$value['tongslXuatNB'];
            $sanpham->tienton =(int)$value['tiendk'] + ((int)$value['tongtiennhap']);
          }else {
// dbg($value);
            $sanpham = new SanphamThongke();

            $sanpham->masp = $value['idPro'];
            $sanpham->proName = $value['proName'];
            $sanpham->cuahang_id = (int)$value['cuahang_id'];
            $sanpham->cate_id = (int)$value['cate_id'];

            $sanpham->sldauky = (int)$value['sldauky'];
            $sanpham->tiendauky = (int)$value['tiendk'];

            $sanpham->slnhap = (int)$value['tongslnhap'];
            $sanpham->tiennhap = (int)$value['tongtiennhap'];

            $sanpham->slxuat = (int)$value['tongslKH'];
            $sanpham->tienxuat =(int)$value['tongtienKH'];

            $sanpham->slxuatnb = (int)$value['tongslXuatNB'];
            $sanpham->slnhapnb = (int)$value['tongslNhapNB'];


            $sanpham->slton = (int)$value['sldauky'] + ((int)$value['tongslnhap'] + (int)$value['tongslNhapNB']) - ((int)$value['tongslKH'] + (int)$value['tongslXuatNB']);
            $sanpham->tienton =(int)$value['tiendk'] + ((int)$value['tongtiennhap']);
          }
          
          $sanpham->save();

        }
      }


      // dbg($post['NhanbanSearch']);
    }
    
    return $this->render('nhankhac', [
          'data' => $data,
          'searchModel' => $searchModel,
      ]);
  }

}
