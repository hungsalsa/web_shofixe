<?php

namespace backend\modules\common\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\sanpham\models\Thongkesp;
use backend\modules\sanpham\models\ProductCate;
use backend\modules\common\models\SanphamThongke;
use backend\modules\common\models\SanphamThongkeSearch;
use backend\modules\common\models\ThongkeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\quantri\models\CuaHang;

class ThongkespController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new ThongkeSearch();

        $user = Yii::$app->user->identity;
        if ($user->manager != 1) {
            $cuahang_id = json_decode($user->cuahang_id);
        }else {
            $cuahang_id = [1,2,3,4];
        }

        if (count($cuahang_id) == 1) {
            $searchModel->cuahang_id = $cuahang_id[0];
        }

        $search['cuahang'] = $search['cuahang_query'] = ArrayHelper::map(CuaHang::findAll($cuahang_id),'id','name');

        
        $model= new ProductCate();
        $search['category'] = $search['category_query'] = $model->getAllCate();
        $model= new SanphamThongke();
        $dataPro = $model->getThongke($cuahang_id);
        $dataProduct = $model->getProduct([2]);

        
        if ($searchModel->load($post = Yii::$app->request->post()))
        {
            $cuahang = $post['ThongkeSearch']['cuahang_id'];
            $cate_id = $post['ThongkeSearch']['cate_id'];
            $proId = $post['ThongkeSearch']['proId'];

            if (!empty($cuahang)) {
                foreach ($search['cuahang_query'] as $key => $value) {
                    if (!in_array($key,$cuahang)) {
                        unset($search['cuahang_query'][$key]);
                    }
                }
            }

            $dataPro = $model->getThongke($cuahang,$cate_id,$proId);
        }
            // echo '<pre>';print_r($data);
            // die;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'data' => $dataPro,
            'search' => $search,
            'dataProduct' => $dataProduct,
        ]);
    }

     public function actionTimkiem()
    {
        $searchModel = new ThongkeSearch();

        $user = Yii::$app->user->identity;
        if ($user->manager != 1) {
            $cuahang_id = json_decode($user->cuahang_id);
        }else {
            $cuahang_id = [1,2,3,4];
        }

        $model= new Thongkesp();
        // echo '<pre>';print_r($dataCuahang);die;

        $search['cuahang'] = $search['cuahang_query'] = ArrayHelper::map(CuaHang::findAll($cuahang_id),'id','name');
        $data = $model->getThongKe($search['cuahang_query']);

        if ($searchModel->load($post = Yii::$app->request->post()))
        {
            
            echo '<pre>';print_r($post);
            die;

        }

        return $this->render('capnhat', [
            'searchModel' => $searchModel,
            'data' => $data,
            'search' => $search,
        ]);
    }

}
