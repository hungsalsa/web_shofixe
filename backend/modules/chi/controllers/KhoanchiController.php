<?php

namespace backend\modules\chi\controllers;

use Yii;
use yii\web\HttpException;
use backend\modules\chi\models\ChiKhoanchi;
use backend\modules\chi\models\ChiKhoanchiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\chi\models\ChiLoaichi;
use backend\modules\chi\models\VattuTh;
use backend\modules\chi\models\DungcuThietbi;
use backend\modules\sanpham\models\Product;
use yii\helpers\ArrayHelper;
use backend\modules\quantri\models\Unit;
use yii\widgets\ActiveForm;
use yii\web\Request;
use yii\filters\AccessControl;
class KhoanchiController extends Controller
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
     * Lists all ChiKhoanchi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChiKhoanchiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCapnhatma()
    {
        if (getUser()->manager == false) {
            throw new \yii\web\HttpException(403, 'Bạn không có quyền chỉnh sửa, hãy liên hệ quản lý để thêm mới');
        }
        $data = ChiKhoanchi::find()->where(['status'=>true])->all();
        $dataVattu = VattuTh::find()->where(['status'=>true])->asArray()->all();
        $dataDungcuTB = DungcuThietbi::find()->where(['status'=>true])->asArray()->all();


        $dataPro = Product::find()->where(['status'=>true,'cuahang_id'=>2])->asArray()->all();
        // echo '<pre>';print_r($dataDungcuTB);die;

        $searchModel = new ChiKhoanchiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($get = Yii::$app->request->get('code')) {
            if ($get == 'nhanbansp') {
                foreach ($dataPro as $value) {
                    $khoanchi = ChiKhoanchi::find()->where(['makhoanchi'=>$value['idPro'],'loaichi_id'=>1])->one();
                    if (empty($khoanchi)) {
                        $new_kc = new ChiKhoanchi;
                        $new_kc->makhoanchi = $value['idPro'];
                        $new_kc->name = $value['proName'];
                        $new_kc->donvitinh = $value['unit'];
                        $new_kc->status = true;
                        $new_kc->loaichi_id = 1;
                        $new_kc->updated_at = time();
                        $new_kc->user_add = $value['user_add'];
                        if ($new_kc->save(false)) {
                            // echo '<pre>';
                            // print_r($new_kc->errors);die;
                        };
                    } 
                    else {
                        $khoanchi->name = $value['proName'];
                        $khoanchi->donvitinh = $value['unit'];
                        $khoanchi->status = true;
                        $khoanchi->loaichi_id = 1;
                        $khoanchi->updated_at = time();
                        $khoanchi->user_add = $value['user_add'];
                        // $khoanchi->save();
                        if ($khoanchi->save(false)) {
                            // echo '<pre>';
                            // print_r($khoanchi->errors);die;
                        };
                    }

                    // $khoanchi2 = ChiKhoanchi::find()->where(['makhoanchi'=>$value['idPro'],'loaichi_id'=>2])->one();
                    // if (empty($khoanchi2)) {
                    //     $new_kc = new ChiKhoanchi;
                    //     $new_kc->makhoanchi = $value['idPro'].'PT';
                    //     $new_kc->name = $value['proName'].' PT';
                    //     $new_kc->donvitinh = $value['unit'];
                    //     $new_kc->status = true;
                    //     $new_kc->loaichi_id = 2;
                    //     $new_kc->updated_at = $value['updated_at'];
                    //     $new_kc->user_add = $value['user_add'];
                    //     $new_kc->save();
                    //     // if ($new_kc->save(false)) {
                    //     //     echo '<pre>';
                    //     //     print_r($new_kc->errors);die;
                    //     // };
                    // } else {
                    //     $khoanchi2->name = $value['proName'].' PT';
                    //     $khoanchi2->donvitinh = $value['unit'];
                    //     $khoanchi2->status = true;
                    //     $khoanchi2->loaichi_id = 2;
                    //     $khoanchi2->updated_at = time();
                    //     $khoanchi2->user_add = $value['user_add'];
                    //     $khoanchi2->save();
                    // }
                }


            }
            if ($get == 'vattutieuhao') {
                // echo '<pre>';
                // print_r($get);die;
                foreach ($dataVattu as $value) {
                    $khoanchi = ChiKhoanchi::find()->where(['makhoanchi'=>$value['machi'],'loaichi_id'=>4])->one();
                    if (empty($khoanchi)) {
                        $new_kc = new ChiKhoanchi;
                        $new_kc->makhoanchi = $value['machi'];
                        $new_kc->name = $value['name'];
                        $new_kc->donvitinh = $value['dvt'];
                        $new_kc->status = true;
                        $new_kc->loaichi_id = 4;
                        $new_kc->updated_at = $value['updated_at'];
                        $new_kc->user_add = $value['user_add'];
                        $new_kc->save();
                        
                    } else {
                        $khoanchi->name = $value['name'];
                        $khoanchi->donvitinh = $value['dvt'];
                        $khoanchi->status = true;
                        $khoanchi->loaichi_id = 4;
                        $khoanchi->updated_at = $value['updated_at'];
                        $khoanchi->user_add = $value['user_add'];
                        $khoanchi->save();
                    }
                }
            }

            if ($get == 'dungcutb') {
                // echo '<pre>';
                // print_r($get);die;
                foreach ($dataDungcuTB as $value) {
                    $khoanchi = ChiKhoanchi::find()->where(['makhoanchi'=>$value['madungcu'],'loaichi_id'=>6])->one();
                    if (empty($khoanchi)) {
                        $new_kc = new ChiKhoanchi;
                        $new_kc->makhoanchi = $value['madungcu'];
                        $new_kc->name = $value['name'];
                        $new_kc->donvitinh = $value['donvitinh'];
                        $new_kc->status = true;
                        $new_kc->loaichi_id = 6;
                        $new_kc->updated_at = $value['updated_at'];
                        $new_kc->user_add = $value['user_add'];
                        $new_kc->save();
                        
                    } else {
                        $khoanchi->name = $value['name'];
                        $khoanchi->donvitinh = $value['donvitinh'];
                        $khoanchi->status = true;
                        $khoanchi->loaichi_id = 6;
                        $khoanchi->updated_at = $value['updated_at'];
                        $khoanchi->user_add = $value['user_add'];
                        $khoanchi->save();
                    }
                }
            }
            
        }
        // $dataPro =[];
        return $this->render('capnhatma', [
            'data' => $data,
            'dataVattu' => $dataVattu,
            'dataPro' => $dataPro,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNhanbansp()
    {
        if (getUser()->manager == false) {
            throw new \yii\web\HttpException(403, 'Bạn không có quyền chỉnh sửa, hãy liên hệ quản lý để thêm mới');
        }
        $dataPro = Product::find()->where(['status'=>true])->all();
        $data = [];
        $searchModel = new ChiKhoanchiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('capnhatma', [
            'data' => $data,
            'dataPro' => $dataPro,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChiKhoanchi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ChiKhoanchi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (getUser()->manager == false) {
            throw new \yii\web\HttpException(403, 'Bạn không có quyền thêm mới khoản chi, hãy liên hệ quản lý để thêm mới');
        }
        $model = new ChiKhoanchi();
        $model->scenario = 'create';
        $model->status = true;
        $model->updated_at = time();
        $model->user_add = getUser()->id;


        // lấy danh sách loại chi ko phải phụ tùng lẻ và phụ tùng toa
        $loaichi = new ChiLoaichi();
        $dataLoaichi = $loaichi->AllLC_Khac([1,2,4,6]);
        $dataDonvitinh = ArrayHelper::map(Unit::findAll(['status'=>true]),'id','unitName');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            $model->makhoanchi = strtoupper($post['ChiKhoanchi']['makhoanchi']);
            $model->name = ucfirst($post['ChiKhoanchi']['name']);
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataLoaichi' => $dataLoaichi,
            'dataDonvitinh' => $dataDonvitinh,
        ]);
    }

    /**
     * Updates an existing ChiKhoanchi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (getUser()->manager == false) {
            throw new \yii\web\HttpException(403, 'Bạn không có quyền chỉnh sửa, hãy liên hệ quản lý để thêm mới');
        }
        $model = $this->findModel($id);

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        /*KIỂM TRA XEM CẬP NHẬT CÓ THUỘC CHI PHỤ TÙNG KO? NẾU THUỘC CHI PHỤ TÙNG THÌ KO CHO CHỈNH SỬA*/

        if (in_array($model->loaichi_id,[1,2])) {
            throw new HttpException(403, 'Khoản chi này thuộc loại chi phụ tùng,Bạn không thể chỉnh sửa');
        }

        // lấy danh sách loại chi ko phải phụ tùng lẻ và phụ tùng toa
        $loaichi = new ChiLoaichi();
        $dataLoaichi = $loaichi->AllLC_Khac([1,2,4,6]);

        $dataDonvitinh = ArrayHelper::map(Unit::findAll(['status'=>true]),'id','unitName');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            // echo '<pre>';print_r($post);die; 
            $model->makhoanchi = strtoupper($post['ChiKhoanchi']['makhoanchi']);
            $model->name = ucfirst($post['ChiKhoanchi']['name']);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataLoaichi' => $dataLoaichi,
            'dataDonvitinh' => $dataDonvitinh,
        ]);
    }

    /**
     * Deletes an existing ChiKhoanchi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (getUser()->manager == false) {
            throw new \yii\web\HttpException(403, 'Bạn không có quyền chỉnh sửa, hãy liên hệ quản lý để thêm mới');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ChiKhoanchi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChiKhoanchi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChiKhoanchi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
