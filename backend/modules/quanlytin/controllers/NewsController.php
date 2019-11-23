<?php

namespace backend\modules\quanlytin\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\quanlytin\models\News;
use backend\modules\quanlytin\models\RelatedNewsPosition;
use backend\modules\quanlytin\models\RelatedNewsInterdependent;
use backend\modules\quanlytin\models\Categories;
use backend\modules\quanlytin\models\NewsSearch;
use  backend\modules\auth\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\helpers\Url;
/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
                    'delete' => ['post'],
                    'quickchange' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }
    public function actionIndex()
    {
        // $sitemap = new Sitemap();
        // $sitemap->createSitemap();
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'sort' => SORT_ASC,'created_at' => SORT_DESC];
        // $dataProvider->pagination = ['pageSize' => 10,];
        if (empty($dataProvider)) {
        throw new NotFoundHttpException('Dữ liệu này đang cập nhật, xin vui lòng quay lại sau');
            
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionQuickchange()
    {
        // if ($post = Yii::$app->request->post()) {
        // if ($post = $_POST) {
            // $post = $_POST;
            // dbg($post);
        $post = Yii::$app->request->post();
        $id = $post['id'];
        $model = News::findOne($id);

        if (Yii::$app->user->identity->getRoleName()=='author' && $model->user_add != getUser()->id) {
            return json_encode(["postValue" => "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin"]);
        }

        $authAssis = new AuthAssignment();
        // Lấy quyền của usẻ đăng nhập
        $perrmission = $authAssis->PermissionUser($model->user_add);
        $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        if ($perrmission_login !='admin' && $model->user_add != getUser()->id ) {
            $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            $return =  "Bài này do $result[$perrmission] : ".$model->userAdd->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn";
            return json_encode(["postValue" => $return]);
        }

        

        $field = $post['field'];
        $value_post = $post['value_post'];
        $model->$field = $value_post;
        $result = [
            'id' => $id,
            'value_post' => $value_post,
            'name' => $model->name,
            'field' => $post['field'],
        ];

        $result = array_merge($result,["postValue" => $value_post]);

        
        $model->updated_at = time();
        $model->user_add = getUser()->id;

        if($model->save()==true) {
            return json_encode($result);
        }else {
            $erros = $model->errors;
            $result = array_merge($result,["error" => $erros]);
            return json_encode($result);
        }

        // }

        // return json_encode(array( 'id'=>'chua co gi','abc'=> $_POST['value_post']));
    }

    private function RenderXml()
    {
        $begin = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ';
        $end = '</urlset>
';

        $string = '    <url>
            <loc>http://www.example.com/</loc>
            <lastmod>2005-01-01</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
';
// dbg(Yii::$app->hostInfo);
        $dataCate = Categories::find()->select(['id','cateName','slug','seo_title'])->where(['status'=>true])->all();
        foreach ($dataCate as $category) {
        $string .= '        <url>
            <loc>'.Url::to(['category/index','slug'=>$category->slug]).'
            </loc><priority>0.8</priority>
        </url>
';
        }
        $siteMap = $begin.$string.$end;
dbg(Yii::getAlias("@frontend/web/sitemap.xml"));
        $fp = fopen(Yii::getAlias("@frontend/web/sitemap.xml","w"));

        fwrite($fp, $siteMap);

        fclose($fp);
        // return $this->redirect('/sitemap.xml');
        return $this->render('xml',['siteMap'=>$siteMap]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        $cate = new Categories();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = [];
        }

        $new = new News();
        $dataNews = $new->getAllNews();
         if(empty($dataNews)){
            $dataNews = array();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        
        if ($model->load($post = Yii::$app->request->post())) {

            if ($post['News']['images']!='') {
                $model->images = str_replace(Yii::$app->request->hostInfo.'/','',$post['News']['images']);
            }
            if($post['News']['related_news'] !=''){
                $model->related_news = json_encode($post['News']['related_news']);
            }

            if($post['News']['sort'] ==''){
                $model->sort = 1;
            }

            // vij tris noi bat
            if($post['News']['hot'] !=''){
                $model->hot = json_encode($post['News']['hot']);
            }
            if ($model->save()) {
                if($post['News']['hot'] !=''){
                    // vij tris noi bat
                    foreach ($post['News']['hot'] as $position) {
                        $relatedNewsPosition = new RelatedNewsPosition();
                        $relatedNewsPosition->id_new = $model->id;
                        $relatedNewsPosition->status = true;
                        $relatedNewsPosition->position = $position;
                        $relatedNewsPosition->save();
                    }
                }

                if($post['News']['related_news'] !=''){
                    $them_tin_lienquan = $post['News']['related_news'];
                    foreach ($them_tin_lienquan as $value_them) {
                        $tinlienquan_moi = new RelatedNewsInterdependent();
                        // ::findOne(['id_main'=>$id,'id_related'=>$value]);
                        // pr($id);
                        $tinlienquan_moi->id_main = $model->id;
                        $tinlienquan_moi->id_related = $value_them;
                        $tinlienquan_moi->status = 1;
                        if($tinlienquan_moi->save() == false){
                            pr($tinlienquan->errors);
                        }
                    }
                }

                return $this->redirect(['index']);
            }else{
                dbg($model->errors);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataCate' => $dataCate,
            'dataNews' => $dataNews,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateinter()
    {
        $news= News::findAll(['status'=>true]);
        foreach ($news as $value) {
            if ($value->related_news != '') {
                // echo $value->id;
                $related_news = json_decode($value->related_news);
                foreach ($related_news as $related_new) {
                    $new_news = new RelatedNewsInterdependent();
                    $new_news->id_main= $value->id;
                    $new_news->id_related= $related_new;
                    $new_news->status= true;
                    $new_news->save();
                }
                
            }
            pr($value->related_news);
        }
        // dbg($news);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->user->identity->getRoleName()=='author' && $model->user_add != getUser()->id) {
            throw new \yii\web\HttpException(403, "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin");
        }

        $model->updated_at = time();
        $model->user_edit = Yii::$app->user->id;

        $authAssis = new AuthAssignment();
        $perrmission = $authAssis->PermissionUser($model->user_add);
        // Lấy quyền của usẻ đăng nhập
        $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        if ($perrmission_login !='admin' && $model->user_add != getUser()->id ) {
            $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            throw new \yii\web\HttpException(403, "Bài này do $result[$perrmission] : ".$model->userad->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn");
        }

        if($model->related_news !=''){
            // $model->related_news = $model_related_news = json_decode($model->related_news);
            $model->related_news = json_decode($model->related_news);
        }else {
            $model_related_news = [];
        }

        $model_related_news = RelatedNewsInterdependent::findAll(['id_main'=>$id]);
        if ($model_related_news) {
            $model_related_news = array_values(ArrayHelper::map($model_related_news,'idin','id_related'));
        }
        // dbg($model_related_news);
        if($model->hot !=''){
            $model->hot = json_decode($model->hot);
        }
         $data_hot = array_values(ArrayHelper::map(RelatedNewsPosition::find()->where(['id_new'=>$model->id,'status'=>true])->asArray()->all(),'idrel','position'));
        // dbg($data_hot);
        $cate = new Categories();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            $dataCate = [];
        }
        $new = new News();
        $dataNews = $new->getAllNews();
        unset($dataNews[$model->id]);
         if(empty($dataNews)){
            $dataNews = array();
        }
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            
            if ($post['News']['images']!='') {
                $model->images = str_replace(Yii::$app->request->hostInfo.'/','',$post['News']['images']);
            }else {
                $model->images ='';
            }

            if($post['News']['sort'] ==''){
                $model->sort = 1;
            }

            // xxử lý tin tiên quan
            if($post['News']['related_news'] !=''){
                $model->related_news = json_encode($post['News']['related_news']);
                $post_related_news = $post['News']['related_news'];
            }else {
                $post_related_news = [];
            }

            // Kiểm tra tin xóa và thêm
            if (!empty($model_related_news) || !empty($post_related_news)) {
                $xoa_tin_lienquan = array_diff($model_related_news,$post_related_news);
                if (!empty($xoa_tin_lienquan)) {
                    // $RelatedNewsInterdependent = new RelatedNewsInterdependent();
                    foreach ($xoa_tin_lienquan as $value) {
                        $tinlienquan = RelatedNewsInterdependent::findOne(['id_main'=>$id,'id_related'=>$value]);
                        if ($tinlienquan) {
                            $tinlienquan->status = 0;
                            if($tinlienquan->save() == false){
                                pr($tinlienquan->errors);
                            }
                            
                        }
                    }
                }
                // echo 'tin dl';
                // pr($model_related_news);
                // echo 'post_related_news';
                // pr($post_related_news);
                // echo 'xoa tin';
                // pr($xoa_tin_lienquan);

                $them_tin_lienquan = array_diff($post_related_news,$model_related_news);
                if (!empty($them_tin_lienquan)) {
                    // $RelatedNewsInterdependent = new RelatedNewsInterdependent();
                    foreach ($them_tin_lienquan as $value_them) {
                        $tinlienquan_moi = new RelatedNewsInterdependent();
                        // ::findOne(['id_main'=>$id,'id_related'=>$value]);
                        // pr($id);
                        $tinlienquan_moi->id_main = $id;
                        $tinlienquan_moi->id_related = $value_them;
                        $tinlienquan_moi->status = 1;
                        if($tinlienquan_moi->save() == false){
                            pr($tinlienquan->errors);
                        }
                    }
                }
                // dbg($them_tin_lienquan);
                // echo 'them tin';
            }

            if($post['News']['hot'] !=''){
                $model->hot = json_encode($post['News']['hot']);
            }


            /* START CAAPJ NHẬT VÀO BẢNG VỊ TRÍ */
            $post_hot = $post['News']['hot'];
            // Lấy mảng các vị trí đã xóa đi
            // dbg($post_hot);
            if (!empty($data_hot) || $post_hot != '') {
            $Xoavitri = array_diff($data_hot,$post_hot);
            // Lấy mảng các vị trí đã thêm mới
            $themVitri = array_diff($post_hot,$data_hot);
            if (!empty($Xoavitri = array_diff($data_hot,$post_hot))) {
                $updatePosition = RelatedNewsPosition::find()->where(['id_new'=>$model->id])->andWhere(['IN','position',$Xoavitri])->all();
                foreach ($updatePosition as $position) {
                // Cập nhật lại kích hoạt vị trí
                    $position->status = 0;
                    $position->save();
                }
            }

            if (!empty($themVitri = array_diff($post_hot,$data_hot))) {
                $updatePosition = RelatedNewsPosition::find()->where(['id_new'=>$model->id])->andWhere(['IN','position',$themVitri])->all();
                if ($updatePosition) {
                        foreach ($updatePosition as $position) {
                    // Cập nhật lại kích hoạt vị trí
                        $position->status = 1;
                        $position->save();
                    }
                } else {
                    foreach ($themVitri as $position) {
                        $relatedNewsPosition = new RelatedNewsPosition();
                        $relatedNewsPosition->id_new = $model->id;
                        $relatedNewsPosition->status = true;
                        $relatedNewsPosition->position = $position;
                        $relatedNewsPosition->save();
                    }
                    
                }
            }
            }

            /* END : CẬP NHẬT VÀO BẢNG VỊ TRÍ */

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataCate' => $dataCate,
            'dataNews' => $dataNews,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        $authAssis = new AuthAssignment();
        // Lấy quyền của usẻ đăng nhập
        $perrmission = $authAssis->PermissionUser($model->user_add);
        $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        if ($perrmission_login !='admin' && $model->user_add != getUser()->id ) {
            $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            throw new \yii\web\HttpException(403, "Bài này do $result[$perrmission] : ".$model->userad->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn");
        }

        // Xóa tất cả các vị trí của tin
        $lien_quan = RelatedNewsPosition::deleteAll(['id_new'=>$model->id]);
        // Xóa tất cả các tin liên quan
        $lien_quan = RelatedNewsInterdependent::deleteAll(['id_main'=>$model->id]);

        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
