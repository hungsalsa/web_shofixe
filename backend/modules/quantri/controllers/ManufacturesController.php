<?php

namespace backend\modules\quantri\controllers;

use Yii;
use backend\modules\quantri\models\Manufactures;
use backend\modules\quantri\models\ManufacturesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quantri\models\SeoUrl;
use yii\widgets\ActiveForm;
/**
 * ManufacturesController implements the CRUD actions for Manufactures model.
 */
class ManufacturesController extends Controller
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
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * Lists all Manufactures models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManufacturesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Manufactures model.
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
     * Creates a new Manufactures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Manufactures();
        $seo = new SeoUrl();

        $model->active = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {

            if ($post['Manufactures']['image']!='') {
                $model->image = str_replace(Yii::$app->request->hostInfo.'/','',$post['Manufactures']['image']);
            }
           
            // $model->slug = $post['SeoUrl']['slug'];
            $seo->slug = $post['SeoUrl']['slug'];
            if ($model->save()) {
                $seo->query = 'manufacture_id='.$model->idMan;
                $seo->save();
                return $this->redirect(['view', 'id' => $model->idMan]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo,
        ]);
    }

    /**
     * Updates an existing Manufactures model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = new SeoUrl();
        $idseo = $seo->getId($model->slug);
        if($idseo){
            $seo = SeoUrl::findOne($idseo);
            unset($idseo);
        }

        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {

            if ($post['Manufactures']['image']!='') {
                $model->image = str_replace(Yii::$app->request->hostInfo.'/','',$post['Manufactures']['image']);
            }
           
            // $model->slug = $post['SeoUrl']['slug'];
            $seo->slug = $post['SeoUrl']['slug'];
            if ($model->save()) {
                $seo->query = 'manufacture_id='.$model->idMan;
                $seo->save();
                return $this->redirect(['view', 'id' => $model->idMan]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'seo' => $seo,
        ]);
    }

    /**
     * Deletes an existing Manufactures model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $seo = new SeoUrl();
        $idseo = $seo->getId($model->slug);
        if($idseo){
            $seo = SeoUrl::findOne($idseo);
            unset($idseo);
            $seo->delete();
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Manufactures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Manufactures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Manufactures::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionValidation() {
        $model = new Manufactures();
       if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }
}
