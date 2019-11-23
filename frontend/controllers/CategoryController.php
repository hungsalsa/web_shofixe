<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\AppController;
use frontend\modules\quantri\models\Categories;
use app\modules\quantri\models\FNews;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class CategoryController extends AppController
{
	public function actionIndex($slug,$page=1)
	{
		// pr($page);
		$cate = new Categories();
		
		if (!$id = $cate->getId($slug)) {
			throw new NotFoundHttpException('Dữ liệu này đang cập nhật hoặc không tồn tại, Xin vui lòng quay lại sau');
		}

		$CateIDList = $cate->getAllChildByID($id);
		$dataCate = $cate->getCategoryAll($CateIDList);
		$dataCate_Seo = reset($dataCate);
    	// $dataCate = Categories::findOne(['id'=>$cate->getId($slug),'status'=>true]);
		$dataNew=[];
		$model = new FNews();

		$news = $model->getAllNews($CateIDList);
		$pages = $model->dataPagerNews($CateIDList);

		// Lấy danh sách các danh mục con và cha nó
		$dataCatetag = $cate->getParentCate($id);
			// $news = $model->dataPagerNews($CateIDList,array_keys($idNew));
		if ($page>1) {
			$dataCate_Seo['seo_descriptions'] .= ' | trang '.$page;
			$dataCate_Seo['seo_title'] .= ' | trang '.$page;
		}

		$dataNew = [
			'news'=>$news,
			'pages'=>$pages,
		];
		Yii::$app->view->registerMetaTag([
			'name' => 'keywords',
			'content' => $dataCate_Seo['keyword']
		]);
		Yii::$app->view->registerMetaTag([
			'name' => 'description',
			'content' => $dataCate_Seo['seo_descriptions']
		]);
		

		if (empty($news)) {
			throw new NotFoundHttpException('Dữ liệu này đang cập nhật, xin vui lòng quay lại sau');
		}
		return $this->render('index',[
			'dataCatetag'=>$dataCatetag,
			'dataNew'=>$dataNew,
			'dataCate'=>$dataCate,
			'seo_title'=>$dataCate_Seo['seo_title']
		]);
	}

	public function actionPostnews()
	{
		$dataNew = FNews::find()->where(['status'=>true])->orderBy(['created_at' => SORT_DESC,'sort' => SORT_DESC])->asArray()->all();
		// echo '<pre>';
		// print_r($dataCate);
		// die;
		return $this->render('postnews',['dataNew'=>$dataNew]);
	}

}
