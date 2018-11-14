<?php

namespace backend\modules\setting\controllers;

use Yii;
use backend\modules\setting\models\SettingCategoryHome;
use backend\modules\setting\models\Model;
use backend\modules\setting\models\SettingDisplayProductType;
use backend\modules\setting\models\SettingDisplayProductTypeSearch;
use backend\modules\setting\models\SettingCategoryHomeSearch;
use backend\modules\quantri\models\ProductCategory;
use backend\modules\quantri\models\ProductType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\ArrayHelper;
/**
 * CategoryhomeController implements the CRUD actions for SettingCategoryHome model.
 */
class CategoryhomeController extends Controller
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
     * Lists all SettingCategoryHome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingCategoryHomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SettingCategoryHome model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $addresses = $model->displayProductType;

        $searchModel = new SettingDisplayProductTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('category_home_id = '.$id);
        return $this->render('view', [
            'model' => $model,
            // 'addresses' => $addresses,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SettingCategoryHome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SettingCategoryHome();

        $cate = new ProductCategory();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            throw new NotFoundHttpException('Bạn hãy tạo danh mục sản phẩm trước khi cài đặt !');
        }

        $cate = new ProductType();
        $dataProductType = $cate->getAllProductType();
        if(empty($dataProductType)){
            throw new NotFoundHttpException('Bạn hãy tạo loại sản phẩm trước khi cài đặt !');
        }

        $dataLocation = [
            1=>'Vị trí số 1',
            2=>'Vị trí số 2',
            3=>'Vị trí số 3',
        ];

        $model->status = true;
        $model->updated_at = time();
        $model->user_update = Yii::$app->user->id;

        $modelsProductType = [new SettingDisplayProductType];

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = 'json';
        //     return ActiveForm::validate($model);
        // }

        if ($model->load(Yii::$app->request->post())) {



            $modelsProductType = Model::createMultiple(SettingDisplayProductType::classname());
            Model::loadMultiple($modelsProductType, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsProductType),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProductType) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsProductType as $modelProductType) {
                            $modelProductType->category_home_id = $model->id;
                            if (! ($flag = $modelProductType->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }




            // return $this->redirect(['view', 'id' => $model->id]);
        // }

        return $this->render('create', [
            'model' => $model,
            'dataCate' => $dataCate,
            'dataLocation' => $dataLocation,
            'dataProductType' => $dataProductType,
            'modelsProductType' => (empty($modelsProductType)) ? [new SettingDisplayProductType] : $modelsProductType
        ]);
    }

    /**
     * Updates an existing SettingCategoryHome model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $cate = new ProductCategory();
        $dataCate = $cate->getCategoryParent();
        if(empty($dataCate)){
            throw new NotFoundHttpException('Bạn hãy tạo danh mục sản phẩm trước khi cài đặt !');
        }

        $cate = new ProductType();
        $dataProductType = $cate->getAllProductType();
        if(empty($dataProductType)){
            throw new NotFoundHttpException('Bạn hãy tạo loại sản phẩm trước khi cài đặt !');
        }

        $dataLocation = [
            1=>'Vị trí số 1',
            2=>'Vị trí số 2',
            3=>'Vị trí số 3',
        ];

        $model->updated_at = time();
        $model->user_update = Yii::$app->user->id;

        $modelsProductType = $model->displayProductType;

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = 'json';
        //     return ActiveForm::validate($model);
        // }

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsProductType, 'id', 'id');
            $modelsProductType = Model::createMultiple(SettingDisplayProductType::classname(), $modelsProductType);
            Model::loadMultiple($modelsProductType, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsProductType, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsProductType),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProductType) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            SettingDisplayProductType::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsProductType as $modelProductType) {
                            $modelProductType->category_home_id = $model->id;
                            if (! ($flag = $modelProductType->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
            // return $this->redirect(['view', 'id' => $model->id]);
        // }

        return $this->render('update', [
            'model' => $model,
            'dataCate' => $dataCate,
            'dataLocation' => $dataLocation,
            'dataProductType' => $dataProductType,
            'modelsProductType' => (empty($modelsProductType)) ? [new SettingDisplayProductType] : $modelsProductType
        ]);
    }

    /**
     * Deletes an existing SettingCategoryHome model.
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
     * Finds the SettingCategoryHome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SettingCategoryHome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SettingCategoryHome::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
