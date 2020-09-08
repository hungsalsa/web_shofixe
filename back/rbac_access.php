<?
use yii\filters\AccessControl;
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
				'logout' => ['post'],
				'delete' => ['post'],
				'delete-multiple' => ['post'],
			],
		],
	];
}