<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\modules\quantri\models\FNews;
use frontend\modules\quantri\models\Categories;
use app\models\Mydatetime;
class DetailController extends \yii\web\Controller
{
    public function actionIndex($slug)
    {
    	$model = new FNews();
        $category = new Categories();
        $dataNew = $model->getNewDetail($slug);
        if (empty($dataNew)) {
            throw new NotFoundHttpException('Dữ liệu này đang cập nhật hoặc không tồn tại, Xin vui lòng quay lại sau');
        }
        $dataLienquan=[];
        if (!empty($dataNew->tinlienquan)) {
            $dataLienquan = ArrayHelper::map($dataNew->tinlienquan,'idin','id_related');
            $dataLienquan=$model->getNewAll($dataLienquan);
        }
        $cungchuyenmuc = $model->getAllnewsByCateID($dataNew->category_id,12,$dataNew->id);
    	if (empty($dataNew)) {
    		throw new NotFoundHttpException('Dữ liệu bạn tìm kiếm không tồn tại'); 
    	}

        // $dataId = $category->getAllChildByID($dataNew->category_id);;
        $dataCate = $category->getParentCate($dataNew->category_id);

        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $dataNew->seo_descriptions
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $dataNew->seo_keyword
        ]);
        $dataNew->view +=1;$dataNew->save();//dbg($dataNew->errors);
        $datetime = new Mydatetime();
        return $this->render('index',[
            'data'=>$dataNew,
            'dataLienquan'=>$dataLienquan,
            'cungchuyenmuc'=>$cungchuyenmuc,
            'dataCate'=>$dataCate,
            // 'datetime'=>$datetime->sw_get_current_weekday(getdate()['weekday'],time())
        ]);
    }

    public function actioSearch($key_search)
    {
        dbg($key_search);
    }

}
