<?php

namespace backend\modules\common\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use backend\modules\common\models\Thongkesp;
use backend\modules\common\models\Tknoibo;
use backend\modules\common\models\SanphamThongke;
use backend\modules\common\models\SanphamThongkeSearch;
use backend\modules\common\models\Capnhat;
use backend\modules\quantri\models\CuaHang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * SanphamThongkeController implements the CRUD actions for SanphamThongke model.
 */
class SanphamThongkeController extends Controller
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
                ],
            ],
        ];
    }
    

    /**
     * Lists all SanphamThongke models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SanphamThongkeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($this->login()->manager != 1) {
            $cuahang_id = json_decode($this->login()->cuahang_id);
            $dataProvider->query->andWhere(['IN','cuahang_id',$cuahang_id]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SanphamThongke model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $cuahang_id = json_decode($this->login()->cuahang_id);
        $model = $this->findModel($id);
        if (!in_array($model->cuahang_id,$cuahang_id) && $this->login()->manager != 1) {
            throw new HttpException(403, 'Bạn không có quyền vào đây, chưa chia sẻ quyền');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SanphamThongke model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCapnhatton()
    {
        if ($post = Yii::$app->request->post()) {
            // $cuahang = $post['cuahang'];
            $cuahang_id = explode(',', $post['cuahang']);
            // dbg($cuahang_id);

            $model= new Thongkesp();
            $data = $model->getThongKe($cuahang_id);

            foreach ($data as $value) {
            //     if ($value['idPro']=='3528702796498' && $value['cuahang_id']==1) {
            // dbg($value);
                    
            //     }else {
            //         continue;
            //     }
                $sanpham = SanphamThongke::findOne(['masp'=>$value['idPro'],'cuahang_id'=>$value['cuahang_id']]);
                
                    // dbg($data);
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

                    $sanpham = new SanphamThongke();

                    $sanpham->masp = $value['idPro'];
                    $sanpham->cate_id = (int)$value['cate_id'];
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

            $model= new SanphamThongke();
            $cache = Yii::$app->cache;
            if ($cache->get('cache_app_sanpham_ton') === true) {
                $cache->delete('cache_app_sanpham_ton');
            }
            
            $product = $model->getThongke($cuahang_id,true);

            Yii::$app->cache->set('cache_app_sanpham_ton', $product, 28800);//set cache trong 8 tieng

            return $this->redirect(['/common/tksanpham']);
        }
        

        // return $this->render('capnhat', [
        //     'searchModel' => $searchModel,
        //     'data' => $data,
        // ]);
    }

    public function actionCreate()
    {
        $model = new SanphamThongke();

        throw new HttpException(403, 'Bạn không có quyền vào đây, không phải tạo mới ở đây');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SanphamThongke model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionChuyenkhotk()
    {
        $chuyennb =new Tknoibo();
        $data = $chuyennb->getAllChuyenNB();
        echo time();
        echo '<pre>';
        print_r($data);die;

        return $this->render('chuyenkhtk', [
            'data' => $data,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cuahang_id = json_decode($this->login()->cuahang_id);
        if (!in_array($model->cuahang_id,$cuahang_id) && $this->login()->manager != 1) {
            throw new HttpException(403, 'Bạn không có quyền vào đây, chưa chia sẻ quyền');
        }
        throw new HttpException(403, 'Bạn không có quyền vào đây, không phải tạo mới ở đây');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SanphamThongke model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        throw new HttpException(403, 'Bạn không có quyền vào đây, không phải tạo mới ở đây');
        $model = $this->findModel($id);
        $cuahang_id = json_decode($this->login()->cuahang_id);
        if ($this->login()->id != 1) {
            throw new HttpException(403, 'Bạn không có quyền vào đây, chưa chia sẻ quyền');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SanphamThongke model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SanphamThongke the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function login()
    {
        $user = Yii::$app->user->identity;
        if ($user) {
            return $user;
        }

        throw new NotFoundHttpException('Chưa đăng nhập.');
    }
    protected function findModel($id)
    {
        if (($model = SanphamThongke::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
