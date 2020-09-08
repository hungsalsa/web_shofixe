<?php

namespace backend\modules\doanhthu\controllers;

use Yii;
use backend\modules\doanhthu\models\DoanhthuKhac;
use backend\modules\doanhthu\models\DoanhThu;
use backend\modules\doanhthu\models\DoanhthuKhacSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DoanhthukhacController implements the CRUD actions for DoanhthuKhac model.
 */
class DoanhthukhacController extends Controller
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
     * Lists all DoanhthuKhac models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $doanhthu = new DoanhThu();
        $this->findModelDoanhthu($id);
        $doanhthuInfo = $doanhthu->getDoanhthuinfo($id);
        // if(!$doanhthuInfo){
        //     throw new NotFoundHttpException('Không .');
        // }
        // echo '<pre>';print_r($doanhthuInfo);die;
        $searchModel = new DoanhthuKhacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('doanhthu_id = '.$id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'doanhthuInfo' => $doanhthuInfo,
        ]);
    }

    /**
     * Displays a single DoanhthuKhac model.
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
     * Creates a new DoanhthuKhac model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new DoanhthuKhac();
        
        // Gans doanh thu cho thu khác
        $model->doanhthu_id = $id;

        // Tìm kiếm doanh thu với id
        $modelDoanhthu = $this->findModelDT($id);

        if ($model->load($post = Yii::$app->request->post())) {

            // Tìm tất cả các doanh thu đã có cộng với money post lên => gán vào thu_khac
            $total = $model->getAll_money_ByDoanhthu($id);
            $total_money = $total + $post['DoanhthuKhac']['money'];
            $modelDoanhthu->thu_khac = $total_money;    

            $modelDoanhthu->chenh_lech = $modelDoanhthu->tong_tien_mat + $modelDoanhthu->tien_chi -  $modelDoanhthu->giao_sang - $modelDoanhthu->tong_doanh_thu_phieu - $total_money;

            $modelDoanhthu->doanh_thu_thuc = $modelDoanhthu->tong_doanh_thu_phieu + $modelDoanhthu->chenh_lech + $total_money;
            

         // echo '<pre>';
         //        // print_r();
         //    // print_r($modelDoanhthu);
         //        print_r($modelDoanhthu);
         //        die;
           
           
            if($model->save() && $modelDoanhthu->save()){
                    return $this->redirect(['index', 'id' => $id]);
            }
            else {
                echo '<pre>';
                var_dump($modelDoanhthu->errors);die;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DoanhthuKhac model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        $modelDoanhthu = $this->findModelDT($model->doanhthu_id);
        $thu_cu = $model->money;

// echo '<pre>';print_r($modelDoanhthu);die;
        if ($model->load($post = Yii::$app->request->post())) {

            // Tìm tất cả các doanh thu đã có cộng với money post lên => gán vào thu_khac
            // $total = $model->getAll_money_ByDoanhthu($model->doanhthu_id);
            // $total_money = $total + $post['DoanhthuKhac']['money'];
            $tong_thu_khac = DoanhthuKhac::getAll_money_ByDoanhthu($post['DoanhthuKhac']['doanhthu_id']);
            $modelDoanhthu->thu_khac = $tong_thu_khac;

            // tính chênh lệch
            $chenh_lech = $modelDoanhthu->tong_tien_mat + $modelDoanhthu->tien_chi - $modelDoanhthu->giao_sang - $modelDoanhthu->tong_doanh_thu_phieu - $tong_thu_khac;

            $modelDoanhthu->chenh_lech = $chenh_lech;

            // $modelDoanhthu->doanh_thu_thuc = $modelDoanhthu->tong_doanh_thu_phieu + $thu_cu - $post['DoanhthuKhac']['money'];
            

         // echo '<pre>';
         //        print_r($post);
         //    print_r(DoanhthuKhac::getAll_money_ByDoanhthu($post['DoanhthuKhac']['doanhthu_id']));
         // //        print_r($modelDoanhthu);
         //        die;
           
           
            if($model->save() && $modelDoanhthu->save()){
                    return $this->redirect(['index', 'id' => $model->doanhthu_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DoanhthuKhac model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // echo '<pre>';

        // print_r($model);die;
        $model->delete();

        return $this->redirect(['index','id'=>$model->doanhthu_id]);
    }

    /**
     * Finds the DoanhthuKhac model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoanhthuKhac the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DoanhthuKhac::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelDoanhthu($id)
    {
        if (($model = DoanhThu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Không thể thêm doanh thu cho ngày này vì chưa được tạo.');
    }

    protected function findModelDT($id)
    {
        if (($model = DoanhThu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Không tìm thấy bản ghi nào');
    }
}
