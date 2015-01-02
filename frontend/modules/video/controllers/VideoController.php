<?php

namespace app\modules\video\controllers;

use Yii;
use app\modules\video\models\Video;
use app\modules\video\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\video\models\Videoon;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller {

    public function behaviors() {
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
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
     * @param integer $id
     * @return mixed
     * 
     * Method change for work with aliases
     */
    public function actionView($id='', $alias='') {

        // Для работы алиасов внесем условие
        if($id) {
        $model = $this->findModel($id);
        }
        elseif ($alias) {
            // Найдем по алиасу
            $model = Video::findOne(['alias' => $alias]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->buy($model->id);
            if (!Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash(
                        'success', yii::t('ru', 'Сообщение об успешной покупке')
                );
            } else {
                Yii::$app->session->setFlash(
                        'success', yii::t('ru', 'Вы не авторизированы')
                );
            }
//          return $this->refresh();
//          return $this->redirect(['view', 'id' => $model->id]);
            return $this->render('view', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('view', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * PJAX ADD VIDEO ON
     * @param type $id
     */
    public function actionUs($id) {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest) {
            echo Videoon::ong($id);
        }
    }

    /**
     * PJAX DELETE VIDEO ON
     * @param type $id
     */
    public function actionUse($id) {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest) {
            echo Videoon::ons($id);
        }
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
