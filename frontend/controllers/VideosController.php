<?php

namespace frontend\controllers;

use Yii;
use app\modules\quantri\models\FVideos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VideosController implements the CRUD actions for Videos model.
 */
class VideosController extends Controller
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
                    // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Videos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '@app/views/layouts/video';
        $model = new FVideos();
        $data = $model->getAllVideo();
        // dbg($data);
        return $this->render('index', [
            'data' => $data['data'],
            'pages' => $data['pages'],
            // 'pagesProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug)
    {
        $this->layout = '@app/views/layouts/video';
        $model = new FVideos();
        $data = $model->getOnevideo($slug);

        // dbg($data);
        // dbg($data['videocate']);
        return $this->render('view', [
            'data' => $data,
            // 'pages' => $data['pages'],
            // 'pagesProvider' => $dataProvider,
        ]);
    }

    public function actionCategory($slug)
    {
        $this->layout = '@app/views/layouts/video';
        $model = new FVideos();
        $data = $model->getVideoByCate($slug);
        // dbg($data);

        // dbg($data);
        // dbg($data['videocate']);
        return $this->render('category', [
            'data' => $data,
            // 'pages' => $data['pages'],
            // 'pagesProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Videos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
}
