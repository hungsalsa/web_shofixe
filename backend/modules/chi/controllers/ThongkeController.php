<?php

namespace backend\modules\chi\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\CuaHang;
use backend\modules\chi\models\ChiLoaichi;
use backend\modules\chi\models\ChiKhoanchi;
use backend\modules\chi\models\ThongkeSearch;
use backend\modules\chi\models\Chingay;
use backend\modules\quantri\models\Employee;
use backend\modules\quantri\models\Motorbike;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\HttpException;
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

      // if ($user->id == 1) {
        // throw new HttpException(403, 'Bạn không có quyền vào đây, chưa chia sẻ quyền');
      // }
      $new_create = new ChiLoaichi();
      // $loaichis['le'] = $new_create->AllLC_le([1,3]);
      // $dataLoaichi = $new_create->AllLC_le();
      $loaichis = $dataLoaichi = $new_create->AllLC_Khac([2]);
      // $loaichis['khac'] = ArrayHelper::map(ChiLoaichi::find()->where(['NOT IN','id',[1,3]])->all(),'id','name');
// dbg($dataLoaichi);

      $dataMotorbike = ArrayHelper::map(Motorbike::findAll(['status'=>true]),'id','bikeName');

      $new_create = new CuaHang();
      $data['cuahang_query'] = $data['cuahangs'] = $new_create->getCuahang_ByUser();
      
      if($user->manager != 1){
            $list = json_decode($user->cuahang_id);
           
            foreach ($data['cuahangs'] as $key => $value) {
                if(!in_array($key, $list)){
                    unset($data['cuahangs'][$key]);
                    unset($data['cuahang_query'][$key]);
                }
            }
        }

        $cuahang_id = '';
        $start_date = date("Y-m-01");
        $end_date = date("Y-m-d");
        
        $new_create = new Chingay();
        $datachi = $new_create->getAllChiByMonth($cuahang_id,$start_date,$end_date);
// dbg($datachi);
        // $new_create = new Chingaykhac();

        $postBike =[];

        if ($searchModel->load($post = Yii::$app->request->post()))
        {
          $cuahang_id = $post['ThongkeSearch']['cuahang_id'];
          $start_date = $post['ThongkeSearch']['start_date'];
          $end_date = $post['ThongkeSearch']['end_date'];
          $loaichi = $post['ThongkeSearch']['loaichi'];

          $postBike = $post['ThongkeSearch']['bike_id'];
          
          if($cuahang_id !=''){
            foreach ($data['cuahang_query'] as $key => $value) {
              if (!in_array($key,$cuahang_id)) {
                unset($data['cuahang_query'][$key]);
              }
            }
            $cuahang_query = $cuahang_id;
          }

          if($loaichi !=''){
            // foreach ($loaichis['le'] as $keylc => $valuelc) {
            //   if (!in_array($keylc,$loaichi)) {
            //     unset($loaichis['le'][$keylc]);
            //   }
            // }

            foreach ($loaichis as $keylc => $valuelc) {
              if (!in_array($keylc,$loaichi)) {
                unset($loaichis[$keylc]);
              }
            }
          }

          if($start_date !=''){
            $start_date = date('Y-m-d',strtotime($start_date));
          }else {
            $start_date = date("Y-m-01");
          }
          if($end_date !=''){
            $end_date = date('Y-m-d',strtotime($end_date));
          }else {
            $end_date = date("Y-m-d");
          }
          $new_create = new Chingay();
          $datachi = $new_create->getAllChiByMonth($cuahang_id,$start_date,$end_date);

          // $new_create = new Chingaykhac();
          // $datachi['khac'] = $new_create->getAllChiByMonth($cuahang_id,$start_date,$end_date);
          // $datachi['le'] = $new_create->getAllChiByMonth($cuahang_id,$start_date,$end_date);
        }
      // echo '<pre>';print_r($datachi['le']);die;
          // echo count($datachi);


        return $this->render('index', [
          'cuahang' => $data['cuahangs'],
          'dataMotorbike' => $dataMotorbike,
          'searchModel' => $searchModel,
          'datachi' => $datachi,
          'data' => $data,
          'loaichis' => $loaichis,
          'dataLoaichi' => $dataLoaichi,
          'postBike' => $postBike,
        ]);
    }

    // Lấy danh sách cửa hàng của user đăng nhập vào, trả về danh sách
    protected function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return json_decode($user->cuahang_id);
       }
       throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
   }

   

}
