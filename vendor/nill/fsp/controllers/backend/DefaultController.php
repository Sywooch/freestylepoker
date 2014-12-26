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

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('_form', [
                    'model' => $model,
        ]);
    }

}
