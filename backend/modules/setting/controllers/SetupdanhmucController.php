<?php

namespace backend\modules\setting\controllers;

use Yii;
use backend\modules\setting\models\CategoryHome;
use backend\modules\setting\models\CategoryHomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quanlytin\models\Categories;

/**
 * SetupdanhmucController implements the CRUD actions for CategoryHome model.
 */
class SetupdanhmucController extends Controller
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
     * Lists all CategoryHome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryHomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryHome model.
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
     * Creates a new CategoryHome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryHome();

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $categories = new Categories();
        $dataLinkCat = $categories->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Updates an existing CategoryHome model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;


        $categories = new Categories();
        $dataLinkCat = $categories->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Deletes an existing CategoryHome model.
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
     * Finds the CategoryHome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryHome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryHome::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
