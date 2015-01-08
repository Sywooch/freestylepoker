<?php

namespace nill\fsp\controllers\frontend;

use nill\fsp\models\backend\Fspstat;
use yii\data\ActiveDataProvider;
use Yii;

class DefaultController extends \yii\web\Controller {

    public function actionIndex()
    {
        $query = Fspstat::find()->where(['user_id' => Yii::$app->user->id]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
