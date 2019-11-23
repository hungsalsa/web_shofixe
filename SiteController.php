<?php
namespace backend\controllers;


use Yii;
use backend\modules\quanlytin\models\Categories;
use backend\modules\quanlytin\models\News;
use backend\modules\quanlytin\models\Sitemap;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
// use backend\models\Sitemap;
use backend\models\Articles;
use backend\models\BCategories;
// use backend\modules\quantri\models\Product;

// namespace app\components;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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

                            $role = $control.'/'.$action;
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
    
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'actions' => ['login', 'error'],
    //                     'allow' => true,
    //                 ],
    //                 [
    //                     'actions' => ['logout', 'index'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

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

    // public function beforeAction($action) 
    // { 
    //     $this->enableCsrfValidation = false; 
    //     return parent::beforeAction($action); 
    // }

    /**
     * Displays homepage.
     *
     * @return string
     */
    
    private function getArticle($idcate_old,$idcate){
        // $Categories = Categories::find()->where(['id'=>$idcate])->asArray()->one();
        // $News = News::find()->where(['status'=>1])->all();
        // $data = Articles::find()->where(['A_CategoryID'=>$idcate_old])->asArray()->all();
        // foreach ($News as $value) {
        //     $value->slug = $this->to_slug($value->slug);
        //     $value->save();
        //     // pr($this->to_slug($value->name));
        // }
        // $BCategories = BCategories::find()->where(['C_ID'=>$idcate_old])->asArray()->one();
        $data = Articles::findAll(['A_CategoryID'=> $idcate_old]);
        // Tạo mới tin vào bảng mới
        foreach ($data as $value) {
            $newallready = News::findOne(['name'=>$value->A_Title]);
            if ($newallready) {
                $newallready->seo_descriptions =$newallready->short_description = strip_tags(preg_replace('/style[^>]*/', '', $value->A_Description));
                if ($value->A_Description == '') {
                    $newallready->seo_descriptions = $value->A_Title;
                    $newallready->short_description = $value->A_Title;
                }
                pr($newallready->danhmuc->cateName);
                pr($newallready->short_description);
                pr($value->A_Description);
                if($newallready->save(false)){
                    pr($newallready->errors);

                }
            }
            continue;
            pr($date= strtotime($value->A_CreatedDate));
            pr(date('d/m/Y',$date));
            // pr(strtotime($value->A_ModifiedDate));
            // pr($value->A_Title);
            // pr($value);
            if ($newallready = News::findOne(['name'=>$value->A_Title])) {
                // dbg($newallready);
                echo 'ngaytao';$newallready->created_at = strtotime($value->A_CreatedDate);
                echo '<br>';
                // if ($value->A_ModifiedDate !='') {
                //     echo $newallready->updated_at = strtotime($value->A_ModifiedDate);
                // }else {
                //     $newallready->updated_at = '';
                // }
                if ($value->A_Description == '') {
                    $newallready->seo_descriptions = $value->A_Title;
                    $newallready->short_description = $value->A_Title;
                }else {
                    $newallready->seo_descriptions = strip_tags(preg_replace('/style[^>]*/', '', $value->A_Description));
                }
                $newallready->save();
                pr($newallready->errors);
                continue;
            }
            $new = new News();
            $new->name = $value->A_Title;
            $new->slug = $value->A_Alias;
            $new->images = str_replace("/taydo_files/images", "tin-tuc", $value->A_Image);
            $new->category_id = $idcate;
            $new->seo_title = $value->A_Title;
            $new->seo_keyword = $value->A_Title;
            $new->seo_descriptions = strip_tags(preg_replace('/style[^>]*/', '', $value->A_Description));
            $new->short_description = $value->A_Description;

            if ($value->A_Description != '') {
                $new->seo_descriptions = $value->A_Title;
                $new->short_description = $value->A_Title;
            }
            $new->content = $value->A_Content;
            $new->popular = 0;
            $new->hot = json_encode([$value->A_Hits]);
            $new->see_more = $value->A_HighLight;
            $new->status = 1;
            $new->user_add = 1;
            $new->created_at = strtotime($value->A_CreatedDate);
            if ($value->A_ModifiedDate !='') {
                    // echo $newallready->updated_at = strtotime($value->A_ModifiedDate);
                    $new->updated_at = strtotime($value->A_ModifiedDate);
                }else {
                    $new->updated_at = '';
                }
            // $new->related_products = $value->A_HighLight;
            // $new->related_news = $value->A_HighLight;

            $new->save();
            pr($new->errors);

        }
dbg('asdada');
        // $data = News::find()->where(['status'=>1,'category_id'=>$idcate])->asArray()->all();
        dbg($data);
        // pr($Categories);
        // dbg($BCategories);
    }

    private function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    public function actionIndex()
    {
        // Chuyển danh sách tin cũ sang mới
        // $this->getArticle(229,1);//Gocs man dam

        // $this->getArticle(227,2);// phan bien chinh luan
        // $this->getArticle(228,2);// phan bien chinh luan
        // $this->getArticle(225,3);// Tin trong nước
        // $this->getArticle(226,4);// Tin qte
        // $this->getArticle(233,8);// Giới trẻ
        // $this->getArticle(236,7);// Giai tri
        // $this->getArticle(230,9);// Khawc hoa chan dung
        $this->layout = 'home';
        
        // $countPro = Product::findAll(['active'=>true]);
        // $data =  ['total_product'=>count($countPro)];
// dbg(Yii::$app->request->hostInfo);
        return $this->render('index');
    }

    public function actionXml()
    {
        $sitemap = new Sitemap();
        $sitemap->createSitemap();
// dbg(\Yii::getAlias('@frontend')."\web\sitemap.xml");
        /*$hostInfo = Yii::$app->request->hostInfo;
        $begin = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ';
        $end = '</urlset>
';

        $string = '    <url>
            <loc>'.$hostInfo.'</loc>
            <changefreq>weekly</changefreq>
            <priority>1</priority>
        </url>
';

        $dataCate = Categories::find()->select(['id','cateName','slug'])->where(['status'=>true])->all();
        foreach ($dataCate as $category) {
        $string .= '        <url>
            <loc>'.$hostInfo.'/'.$category->slug.'</loc>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
';
        }
        $siteMap = $begin.$string.$end;
        $fp = fopen(\Yii::getAlias('@frontend')."\web\sitemap.xml","w");

        fwrite($fp, $siteMap);

        fclose($fp);*/
        return $this->redirect(Yii::$app->homeUrl);
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

        $dataCate = Categories::find()->select(['id','cateName','slug','title'])->where(['status'=>true])->all();
        foreach ($dataCate as $category) {
        $string .= '        <url>
            <loc>'.Url::to(['category/index','slug'=>$category->slug]).'
            </loc><priority>0.8</priority>
        </url>
';
        }
        $siteMap = $begin.$string.$end;
dbg(Yii::$app->hostInfo);
        $fp = fopen(\Yii::$app->hostInfo."/sitemap.xml","w");

        fwrite($fp, $siteMap);

        fclose($fp);
        // return $this->redirect('/sitemap.xml');
        return $this->render('xml',['siteMap'=>$siteMap]);
    }

    // public function actionChangeStatus($id, $currentStatus, $field = 'status') {
    //     $this->layout = false;
    //     $this->autoRender = false;
    //     $model = $this->modelClass;
    //     $checkExisted = $this->$model->find('count', array(
    //         'conditions' => array(
    //             'id' => $id
    //         ),
    //         'recursive' => -1,
    //     ));
    //     if (!$checkExisted) {
    //         return json_encode(array(
    //             'success' => false
    //         ));
    //     }
    //     $newStatus = ($currentStatus+1)%2;
    //     $this->$model->create();
    //     $this->$model->id = $id;
    //     if ($this->$model->saveField($field, $newStatus)) {
    //         if ($model == 'Post') {
    //             $this->$model->create();
    //             $this->$model->id = $id;
    //             $this->$model->saveField('comment', null);
    //         }
    //         Cache::clear();
    //         return json_encode(array(
    //             'success' => true,
    //             'text' => $newStatus?'Kích hoạt':'Tắt',
    //             'newStatus' => $newStatus
    //         ));
    //     }
    //     return json_encode(array(
    //         'success' => false
    //     ));

    // }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('messeage','Chào mừng bạn tới với admin');
            // $sitemap = new Sitemap();
            // $sitemap->actionCreateSitemap();
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }



        if (!\Yii::$app->user->isGuest) {
        return $this->goHome();
        exit;
    }

    

// $model = new LoginForm();
// if ($model->load(Yii::$app->request->post()) && $model->login()) {
// //check user roles, is user is Admin? 
//     if (\Yii::$app->user->can('Admin'))
//     {
//         // yes he is Admin, so redirect page 
//         // return $this->goBack();
//          return $this->redirect(['quantri/productcategory']);
//     }
//     else // if he is not an Admin then what :P
//     {   // put him out :P Automatically logout. 
//         Yii::$app->user->logout();
//         // set error on login page. 
//         \Yii::$app->getSession()->setFlash('error', 'You are not authorized to login Admin\'s penal.<br /> Please use valid Username & Password.<br />Please contact Administrator for details.');
//         //redirect again page to login form.
//         return $this->redirect(['site/login']);
//     }

// } else {
// return $this->render('login', [
//     'model' => $model,
// ]);
// }


    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
    // echo ob_end_flush();
