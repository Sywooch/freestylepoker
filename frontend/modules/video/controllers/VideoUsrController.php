<?php

namespace app\modules\video\controllers;

use Yii;
use app\modules\video\models\VideoUsr;
use app\modules\video\models\VideoUsrSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VideoUsrController implements the CRUD actions for VideoUsr model.
 */
class VideoUsrController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all VideoUsr models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoUsrSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
