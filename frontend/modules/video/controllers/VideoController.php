<?php

namespace app\modules\video\controllers;

use Yii;
use app\modules\video\models\Video;
use app\modules\video\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\video\models\Videoparsed;
use yii\filters\AccessControl;
use nill\comment_widget\models\CommentsClock;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();

        if (!isset($behaviors['access']['class'])) {
            $behaviors['access']['class'] = AccessControl::className();
        }

        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['index', 'view', 'deleteparsed', 'addparsed','gift'],
            'roles' => ['ViewVideo']
        ];
        
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['gift'],
            'roles' => ['administrateVideo']
        ];
        
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get', 'post'],
                'view' => ['get', 'post'],
                'gift' => ['get', 'post'],
            ]
        ];

        return $behaviors;
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
    public function actionView($id = '', $alias = '') {

        // Для работы алиасов внесем условие
        if ($id) {
            $model = $this->findModel($id);
        } elseif ($alias) {
            // Найдем по алиасу
            $model = Video::findOne(['alias' => $alias]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->buy();
            if (Yii::$app->user->isGuest) {
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
            // Обнулить непрочитанные комментарии
            $comments_clock_model = new CommentsClock();
            $comments_clock_model->reset = $model->id;
            
            return $this->render('view', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * PJAX ADD VIDEO parsed
     * @param type $id
     */
    public function actionAddparsed($id) {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest) {
            echo Videoparsed::_add($id);
        } else {
            throw new yii\base\InvalidRouteException('Request is not pjax');
        }
    }

    /**
     * PJAX DELETE VIDEO parsed
     * @param type $id
     */
    public function actionDeleteparsed($id) {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest) {
            echo Videoparsed::_delete($id);
        } else {
            throw new \yii\base\InvalidRouteException('Request is not pjax');
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
    
    /**
     * Подарить
     * @throws \yii\base\InvalidRouteException
     */
    public function actionGift() {
        if (Yii::$app->request->isPjax && !Yii::$app->user->isGuest && Yii::$app->request->post('Video')) {
            echo Video::_gift(Yii::$app->request->post('Video'));
        } else {
            throw new \yii\base\InvalidRouteException('Request is not pjax or empty');
        }
    }

}
