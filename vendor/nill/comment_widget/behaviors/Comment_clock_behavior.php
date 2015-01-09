<?php

namespace nill\comment_widget\behaviors;

use nill\comment_widget\models\CommentsClock;
use app\modules\video\models\Video;
use yii\db\ActiveRecord;
use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Comment_clock_behavior extends \yii\base\Behavior {

    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'deleteComment',
            ActiveRecord::EVENT_AFTER_VALIDATE => 'afterSave',
        ];
    }

    /**
     * Удалить запись о непрочитанных комментариев
     */
    public function deleteComment() {
        $cc = new CommentsClock();
        $ccd = $cc->findOne(['author_id' => Yii::$app->user->id, 'video_id' => $this->owner->model_id]);
        if ($ccd != NULL) {
            $ccd->delete();
        }
    }

    /**
     * Установить непрочитанные комментарии
     */
    public function afterSave($insert) {
        if ($insert) {
            $cc = new CommentsClock();
            $cc->video_id = $this->owner->model_id;

            $video_model = Video::findOne(['id' => $this->owner->model_id]);
            $cc->author_id = $video_model->author_id;
            $cc->save();
        }
    }

}
