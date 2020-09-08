<?php

namespace backend\modules\khachhang\controllers;

use Yii;
use backend\modules\khachhang\models\KhChitietDv;
use backend\modules\khachhang\models\KhChitietDvSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * KhachhangctdichvuController implements the CRUD actions for KhChitietDv model.
 */
class KhachhangctdichvuController extends Controller
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
                        // 'matchCallback'=> function ($rule ,$action)
                        // {
                        //     $control = Yii::$app->controller->id;
                        //     $action = Yii::$app->controller->action->id;
                        //     $module = Yii::$app->controller->module->id;

                        //     $role = $module.'/'.$control.'/'.$action;
                        //     if (Yii::$app->user->can($role)) {
                        //         return true;
                        //     }else {
                        //       throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
                        //     }
                        // }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                    'quickupdate' => ['post'],
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
     * Lists all KhChitietDv models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KhChitietDvSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KhChitietDv model.
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
     * Creates a new KhChitietDv model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KhChitietDv();
        $model->quantity = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KhChitietDv model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionQuickupdate()
    {
        // var_dump($model);

        if ($model->load($post = Yii::$app->request->post())
        {
            return json_encode(array(
                'id'=>$post['id']
            ));
            // $model = $this->findModel($post['id']);

            // pr($model);
            // $model->id_Pro_dv = $post['id_Pro_dv'];
            // $model->price = $post['price'];
            // $model->quantity = $post['quantity'];
            // $model->suffixes = $post['suffixes'];
            // if($model->save())
            // {
            //     return json_encode(array(
            //         'id' => $id,
            //         'id_Pro_dv' => $model->id_Pro_dv,
            //         'price' => $model->price,
            //         'quantity' => $model->quantity,
            //         'suffixes' => $model->suffixes,
            //     ));
            // }
        }

        // $modelnew = $this->findModel($id);

        // return json_encode(array(
        //     'id' => $id,
        //     'id_Pro_dv' => $modelnew->id_Pro_dv,
        //     'price' => $modelnew->price,
        //     'quantity' => $modelnew->quantity,
        //     'suffixes' => $modelnew->suffixes,
        // ));
    }

    public function actionSuachitiet($id,$dichvu)
    {
        $model = $this->findModel($id);

        if ($model->load($get = Yii::$app->request->get())) {
            $model->id_dv = $dichvu;
            $model->id_Pro_dv = $get['id_Pro_dv'];
            $model->price = $get['price'];
            $model->quantity = $get['quantity'];
            $model->suffixes = $get['suffixes'];

            if($model->save(false)) {
                return json_encode(array(
                    'id_Pro_dv' => $model->errors['id_Pro_dv'][0],
                    'price' => $model->errors['price'][0],
                ));
                // print_r($model->errors['id_Pro_dv'][0]);
            }
        }
        return json_encode(array(
            'id_Pro_dv' => $model->errors['id_Pro_dv'][0],
                    'price' => $model->errors['price'][0],
                    'quantity' => $model->errors['quantity'][0],
        ));
        // return json_encode(array(
        //     'id' => $id,
        //     'id_Pro_dv' => $model->id_Pro_dv,
        //     'price' => $model->price,
        //     'quantity' => $model->quantity,
        //     'suffixes' => $model->suffixes,
        // ));

       
    }

    /**
     * Deletes an existing KhChitietDv model.
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
     * Finds the KhChitietDv model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KhChitietDv the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KhChitietDv::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
