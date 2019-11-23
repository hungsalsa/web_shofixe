<?php

namespace backend\modules\setting\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\setting\models\SettingModules;
use backend\modules\setting\models\ModulesPosition;
use backend\modules\setting\models\SettingModulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use backend\modules\quanlytin\models\Categories;
use yii\filters\AccessControl;
/**
 * SettingModulesController implements the CRUD actions for SettingModules model.
 */
class SettingModulesController extends Controller
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
                    // 'laygia' => ['post'],
                    // 'subcat' => ['post'],
                    // 'delete' => ['post'],
                    // 'suachitiet' => ['post'],
                    // 'xoachitiet' => ['post'],
                    // 'checkvitri' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all SettingModules models.
     * @return mixed
     */
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }
    public function actionIndex()
    {
        $searchModel = new SettingModulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['sort' => SORT_ASC,'created_at' => SORT_DESC,'updated_at' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SettingModules model.
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
     * Creates a new SettingModules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SettingModules();

        $model->status = true;
        $model->page_show = true;
        $model->created_at = time();
        // $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $categories = new Categories();
        $dataLinkCat = $categories->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }
        // $model->slug = true;

        /*if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }*/
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
// dbg($post);
            if ($post['SettingModules']['positions'] !='') {
                $positions = $post['SettingModules']['positions'];
                $model->positions = json_encode($positions);
            }
            if($post['SettingModules']['sort'] ==''){
                $model->sort = 999;
            }


            if($model->save()){
                foreach ($positions as $value) {
                    if (!ModulesPosition::findOne(['position'=>$value,'module_id'=>$model->id])) {
                        $mPosition = new ModulesPosition();
                        $mPosition->position = $value;
                        $mPosition->status = 1;
                        $mPosition->module_id = $model->id;
                        $mPosition->save();
                        
                    } 
                }
                return $this->redirect(['index']);
            }/*else {
                dbg($model->erros);
            }*/
        }

        return $this->render('create', [
            'model' => $model,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Updates an existing SettingModules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        

        $model->positions = json_decode($model->positions);
        $model->updated_at = time();
        $model->user_edit = Yii::$app->user->id;

        $data_hot = array_values(ArrayHelper::map(ModulesPosition::find()->where(['module_id'=>$model->id,'status'=>true])->asArray()->all(),'id','position'));

        $categories = new Categories();
        $dataLinkCat = $categories->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post()) ) {
            // return $this->redirect(['view', 'id' => $model->id]);

            if ($post['SettingModules']['positions'] !='') {
                $positions = $post['SettingModules']['positions'];
                $model->positions = json_encode($positions);
            }

            if($post['SettingModules']['sort'] ==''){
                $model->sort = 999;
            }
            // pr($model);
            // dbg($post);

            $post_hot = $post['SettingModules']['positions'];
            // pr($data_hot);
            // pr($post_hot);
            // Lấy mảng các vị trí đã xóa đi
            // $Xoavitri = array_diff($data_hot,$post_hot);
            // pr($Xoavitri);
            // Lấy mảng các vị trí đã thêm mới
            // $themVitri = array_diff($post_hot,$data_hot);
            // dbg($themVitri);
            if (!empty($Xoavitri = array_diff($data_hot,$post_hot))) {
                $updatePosition = ModulesPosition::find()->where(['module_id'=>$model->id])->andWhere(['IN','position',$Xoavitri])->all();
                foreach ($updatePosition as $position) {
                // Cập nhật lại kích hoạt vị trí
                    $position->status = 0;
                    $position->save();
                }
            }

            if (!empty($themVitri = array_diff($post_hot,$data_hot))) {
                $updatePosition = ModulesPosition::find()->where(['module_id'=>$model->id])->andWhere(['IN','position',$themVitri])->all();
                if ($updatePosition) {
                        foreach ($updatePosition as $position) {
                    // Cập nhật lại kích hoạt vị trí
                        $position->status = 1;
                        $position->save();
                    }
                } else {
                    foreach ($themVitri as $position) {
                        $ModulesPosition = new ModulesPosition();
                        $ModulesPosition->module_id = $model->id;
                        $ModulesPosition->status = true;
                        $ModulesPosition->position = $position;
                        $ModulesPosition->save();
                    }
                    
                }
            }
                /*foreach ($positions as $value) {
                    if (!ModulesPosition::findOne(['position'=>$value,'module_id'=>$model->id])) {
                        $mPosition = new ModulesPosition();
                        $mPosition->position = $value;
                        $mPosition->module_id = $model->id;
                        $mPosition->save();
                        
                    } 
                }*/


            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Deletes an existing SettingModules model.
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
     * Finds the SettingModules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SettingModules the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SettingModules::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
