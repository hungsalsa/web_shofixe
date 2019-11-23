<?php

namespace backend\modules\quanlytin\controllers;

use Yii;
use backend\modules\quanlytin\models\Pages;
// use backend\modules\quantri\models\Product;
use backend\modules\quanlytin\models\News;
// use backend\modules\quantri\models\SeoUrl;
use backend\modules\quanlytin\models\PagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
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
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
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
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();
        $seo = new SeoUrl();

        $product = new Product();
        $dataProduct = $product->getAllPro();
        
        $news = new News();
        $dataNews = $news->getAllNews();

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {
            if ($post['Pages']['tag_product']!='') {
                $model->tag_product = json_encode($post['Pages']['tag_product']);
            }
            if ($post['Pages']['tag_news']!='') {
                $model->tag_news = json_encode($post['Pages']['tag_news']);
            }

            $model->slug = $post['SeoUrl']['slug'];

            // echo '<pre>';print_r($post);
            // die;

            if($model->save()){
                $seo->query = 'pages_id='.$model->id;
                $seo->save();
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataProduct' => $dataProduct,
            'dataNews' => $dataNews,
            'seo' => $seo,
        ]);
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $seo = new SeoUrl();
        // $idSeo = $seo->getSeoID($model->slug);
        // if ($idSeo) {
        //     $seo = $this->findModelSeo($idSeo);
        // } else {
        //     $seo->slug = '';
        // }

        // $product = new Product();
        // $dataProduct = $product->getAllPro();
        
        $news = new News();
        $dataNews = $news->getAllNews();

        if($model->tag_product !=''){
            $model->tag_product = json_decode($model->tag_product);
        }

        if($model->tag_news !=''){
            $model->tag_news = json_decode($model->tag_news);
        }

        $model->updated_at = time();
        $model->user_id = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {
            // if ($post['Pages']['tag_product']!='') {
            //     $model->tag_product = json_encode($post['Pages']['tag_product']);
            // }
            if ($post['Pages']['tag_news']!='') {
                $model->tag_news = json_encode($post['Pages']['tag_news']);
            }

            if($model->save()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            // 'dataProduct' => $dataProduct,
            'dataNews' => $dataNews,
            // 'seo' => $seo,
        ]);
    }

    /**
     * Deletes an existing Pages model.
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
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // public function actionValidation() {
    //     $model = new SeoUrl();
    //    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
    //         Yii::$app->response->format = 'json';
    //         return ActiveForm::validate($model);
    //     }
    // }

    // protected function findModelSeo($id)
    // {
    //     if (($model = SeoUrl::findOne($id)) !== null) {
    //         return $model;
    //     }

    //     throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
