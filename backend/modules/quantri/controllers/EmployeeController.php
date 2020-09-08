<?php

namespace backend\modules\quantri\controllers;

use Yii;
use backend\modules\quantri\models\Employee;
use backend\modules\quantri\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quantri\models\CuaHang;
use yii\filters\AccessControl;
use yii\helpers\Json;
/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->where(['in', 'cua_hang', json_decode($this->findIdCuahang()->cuahang_id)]);


        // if (Yii::$app->request->post('hasEditable') && Yii::$app->request->post('editableKey')) 
        // {
        //     // Tìm xem nhân viên
        //     if (getUser()->manager != 1) {
        //         $output = 'Bạn ko có quyền sửa nhân viên';
        //     } else {
        //         $editableKey = Yii::$app->request->post('editableKey');
        //         $model = Employee::findOne($editableKey);

        //         // $editableIndex = Yii::$app->request->post('editableIndex');
        //         // $editableAttribute = Yii::$app->request->post('editableAttribute');
        //         // $attribute = $_POST["Employee"][$editableIndex][$editableAttribute];
        //     // print_r($customerItemsId);die();
        //             // $out = Json::encode(['output'=>'', 'message'=>'']);
        //         $post = [];
        //         $posted = current($_POST['Employee']);
        //         $post['Employee'] = $posted;
        //         if ($model->load($post)) 
        //         {
        //             // $model->$editableAttribute = $attribute;
        //             $model->updated_at=time();
        //             $model->user_add = getUser()->id;
        //             $model->save();
        //             $output = '';
        //         } 
        //     }
            
        //     $out = Json::encode(['output'=>$output, 'message'=>'']);
            
        //     echo $out;
        //     return;
        // }

         if (Yii::$app->request->post('hasEditable') && Yii::$app->request->post('editableKey')) 
        {
             \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $editableKey = Yii::$app->request->post('editableKey');
            
            //  else {
            $model = Employee::findOne($editableKey);
            // $out = Json::encode(['output'=>$output, 'message'=>'']);
                $editableIndex = Yii::$app->request->post('editableIndex');
                $editableAttribute = Yii::$app->request->post('editableAttribute');
                $attribute = $_POST["Employee"][$editableIndex][$editableAttribute];
            // print_r($customerItemsId);die();
                $checkPro = Employee::findAll(['id'=>$attribute]);
                if (getUser()->manager != 1) {
                    $output = 'Bạn ko có quyền sửa';
                }else {
                    // $out = Json::encode(['output'=>'', 'message'=>'']);
                    $post = [];
                    $posted = current($_POST['Employee']);
                    $post['Employee'] = $posted;
                    // $post = $posted;
                    if ($model->load($post)) 
                    {
                        // $model->$editableAttribute = $attribute;
                        $model->updated_at=time();
                        $model->user_add = Yii::$app->user->identity->id;
                        $model->save();
                        $output = '';
                    } 
                }
            // }
            
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            
            echo $out;
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();

        $model->created_at = time();
        $model->updated_at = time();
        $model->status = true;
        $model->user_add = Yii::$app->user->id;

        $location = array(
            1 =>'Quản lý',
            2 =>'Cửa hàng trưởng',
            3 =>'Kế toán',
            4 =>'Nhân viên'
        );

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            $dataCuahang = array();
        }

        if ($model->load($post = Yii::$app->request->post())) {

            if ($post['Employee']['cua_hang'] !='') {
                $model->cua_hang = json_encode($post['Employee']['cua_hang']);
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'location' => $location,
            'dataCuahang' => $dataCuahang,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        $model->cua_hang = json_decode($model->cua_hang);
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $location = array(
            1 =>'Quản lý',
            2 =>'Cửa hàng trưởng',
            3 =>'Kế toán',
            4 =>'Nhân viên'
        );

        $cuahang = new CuaHang();
        $dataCuahang = $cuahang->getAllCuahang();
        if(empty($dataCuahang)){
            $dataCuahang = array();
        }

        if ($model->load($post = Yii::$app->request->post())) {

            if ($post['Employee']['cua_hang'] !='') {
                $model->cua_hang = json_encode($post['Employee']['cua_hang']);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'location' => $location,
            'dataCuahang' => $dataCuahang,
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    // Lấy danh sách cửa hàng của user đăng nhập vào, trả về danh sách
    protected function findIdCuahang(){
     if($user = Yii::$app->user->identity){
         return $user;

     }
     throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
 }

 protected function findModel($id)
 {
    if (($model = Employee::findOne($id)) !== null) {
        return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
}
}
