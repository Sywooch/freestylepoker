<?php

namespace nill\comment_widget\behaviors;

use app\modules\video\models\CommentsClock;
use yii\db\ActiveRecord;
use Yii;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Comment_clock_behavior extends \yii\base\Behavior {

    /**
     * EVENT_BEFORE_INSERT и EVENT_BEFORE_UPDATE
     * возможно лучше заменить на EVENT_AFTER_VALIDATE
     */
    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'deleteComment',
            ActiveRecord::EVENT_AFTER_VALIDATE => 'afterSave',
        ];
    }
    
    
    /**
     * Delete comment.
     *
     * @return boolean Whether comment was deleted or not
     */
    public function deleteComment() {

        // Удалить запись о непрочитанных комментариев
        $cc = new CommentsClock();
        $ccd = $cc->findOne(['author_id' => Yii::$app->user->id, 'video_id' => $this->owner->model_id]);
        if ($ccd != NULL) {
            $ccd->delete();
        }
    }

    public function afterSave($insert) {

        // Установить непрочитанные комментарии
        if ($insert) {
            $cc = new CommentsClock();
            $cc->video_id = $this->owner->model_id;

            // !!! Найти автора видео!!!
            $cc->author_id = Yii::$app->user->id;
            $cc->save();
        }
    }
}
