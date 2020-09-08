<?php

namespace backend\modules\phieu\controllers;

use Yii;
use backend\modules\phieu\models\PhieuSophieu;
use backend\modules\phieu\models\PhieuSophieuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SophieuController implements the CRUD actions for PhieuSophieu model.
 */
class SophieuController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PhieuSophieu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhieuSophieuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // Kiểm tra xem có phải quản lý không
        $user = Yii::$app->user->identity;
        if ($user->manager != 1) {
            $dataProvider->query->andWhere(['in', 'cuahang_id', $this->findIdCuahang()]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhieuSophieu model.
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
     * Creates a new PhieuSophieu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhieuSophieu();
        $user = Yii::$app->user->identity;
        if($user->view_cuahang == 1 ){
            throw new NotFoundHttpException('Bạn chi có quyền xem không có quyền thêm mới');
        }

        if($user->id != 1){
            throw new NotFoundHttpException('Bạn không có quyền thêm mới, chỉ admin mới có quyền');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PhieuSophieu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // Kiểm tra xem có phải quản lý không
        $user = Yii::$app->user->identity;
        if ($user->manager != 1) {
            throw new NotFoundHttpException('Bạn không có đủ quyền vào đây , hãy liên hệ với admin để hỗ trợ bạn');
        }

        if($user->id != 1){
            throw new NotFoundHttpException('Bạn không có quyền thêm mới, chỉ admin mới có quyền');
        }

        $model = $this->findModel($id);

        // echo '<pre>';print_r($model);die;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PhieuSophieu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = Yii::$app->user->identity;
        if ($user->manager != 1 || $user->id != 1) {
            throw new NotFoundHttpException('Bạn không có đủ quyền xóa phiếu , hãy liên hệ với admin để hỗ trợ bạn');
        }




        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhieuSophieu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhieuSophieu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhieuSophieu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findIdCuahang(){
       if($user = Yii::$app->user->identity){
           return json_decode($user->cuahang_id);

       }
       throw new NotFoundHttpException('Bạn không có quyền tại cửa hàng nào');
    }
}
