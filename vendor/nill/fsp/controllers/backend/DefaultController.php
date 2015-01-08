<?php

namespace nill\fsp\controllers\backend;

use nill\fsp\models\backend\Fspstat;
use Yii;

class DefaultController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionForm() {
        $model = new Fspstat();
        $model->setScenario('change-gold');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $this->render('form', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('form', [
                    'model' => $model,
        ]);
    }

}
