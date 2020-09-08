<?php

namespace backend\modules\khachhang\controllers;

use Yii;
use backend\modules\khachhang\models\mdcapnhat;
use backend\modules\khachhang\models\KhXe;
use backend\modules\khachhang\models\KhachHang;
use backend\modules\khachhang\models\KhDichvu;
use backend\modules\quantri\models\CuaHang;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\HttpException;
class NhanbankhController extends \yii\web\Controller
{
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
                              throw new HttpException(403, 'Bạn không có quyền vào đây');
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
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
    public function actionCapnhatdichvu()
    {
        $model = new mdcapnhat();

        $cuahang = new CuaHang();
        $cuahang = $cuahang->getCuahang_ByUser();

        $dataKhachhang = new KhachHang();
        $dataKhachhang = $dataKhachhang->AllKhachhang();


        $data = new KhDichvu();
        $yesterday = date('Y/m/d', strtotime('-1 day', strtotime(date("Y/m/d"))));
        $data = KhDichvu::find()->where(['status'=>0])->andWhere(['<=','day',$yesterday])->orderBy(['day' => SORT_DESC,'cuahang_id'=>SORT_ASC])->all();
        $count['cuahang_id'] = [1,2,3,4,5];
        foreach ($count['cuahang_id'] as $value) {
            $count[$value] = KhDichvu::find()->where(['status'=>0,'cuahang_id'=>$value])->andWhere(['<=','day',$yesterday])->count();
        }

        if ($model->load($post = Yii::$app->request->post())) {

            if ($post['Mdcapnhat']['capnhat'] == 1 && !empty($data)) {
                foreach ($data as $dichvu) {
                    // print_r($dichvu);
                    $dichvu->status = 1;
                    if($dichvu->save(false)){
                        print_r($dichvu->errors);
                    }
                }
            }

            // return Url::to(['capnhatdichvu']);//exit(0);
            return $this->redirect(['capnhatdichvu']);exit(0);
        }
    
        return $this->render('capnhat',[
            'data'=>$data,
            'model'=>$model,
            'cuahang'=>$cuahang,
            'count'=>$count,
            'dataKhachhang'=>$dataKhachhang,
        ]);
    }
    /*
    public function actionIndex()
    {
    	$user_add = array(7,5);
    	$dataKH = KhachHangCopy1::find()->alias('kh')
    	->joinWith('xekh')
    	->where(['in','user_add',$user_add])
    	->all();

    	echo '<pre>';
    	foreach ($dataKH as $value) {
    		$kh_new = new KhachHang();

    		$checkKH = KhachHang::findOne(['phone'=>$value->phone]);
    		if ($checkKH) {
    			continue;
    		}

    		$kh_new->name = $value->name;
    		$kh_new->phone = $value->phone;
    		$kh_new->address = $value->address;
    		$kh_new->created_at = $value->created_at;
    		$kh_new->note = $value->note;
    		$kh_new->status = $value->status;
    		$kh_new->updated_at = $value->updated_at;
    		$kh_new->user_add = $value->user_add;

    		$xekhach = $value->xekh;
    		if ($kh_new->save()) {
	    		foreach ($xekhach as $xe_val) {
		    		$xe_new = new KhXe();
	    			$xe_new->id_KH = $kh_new->idKH;
	    			$xe_new->xe = $xe_val->xe;
	    			$xe_new->bks = $xe_val->bks;
	    			$xe_new->status = $xe_val->status;
	    			$xe_new->nguoi_sd = $xe_val->nguoi_sd;

	    			$xe_new->save();
	    		}
    			
    		}
	    	// print_r($checkKH);
	    	// print_r($value->xekh);
    		// die;
    	}


    	die;
        return $this->render('index');
    }

     public function actionCapnhatdc()
    {
    	$user_add = array(5);
    	$dataKH = KhachHangCopy1::find()->alias('kh')
    	->joinWith('xekh')
    	->where(['in','user_add',$user_add])
    	->all();

    	echo '<pre>';
    	// print_r($dataKH);
    	// 	die;
    	foreach ($dataKH as $value) {
    		$kh_new = KhachHang::findOne(['phone'=>$value->phone]);
    		if (!$kh_new) {
    			continue;
    		}
    		
    		$kh_new->user_add = 9;

    		$kh_new->save();
	    	// print_r($kh_new);
	    	// print_r($value->xekh);
    		// die;
    	}


    	die;
        return $this->render('index');
    }*/

}
