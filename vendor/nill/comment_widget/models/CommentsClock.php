<?php

namespace nill\comment_widget\models;

use Yii;
use app\modules\video\models\Video;

/**
 * This is the model class for table "{{%comments_clock}}".
 *
 * @property integer $video_id
 * @property integer $author_id
 */
class CommentsClock extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%comments_clock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['video_id', 'author_id'], 'required'],
            [['video_id', 'author_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'video_id' => Yii::t('ru', 'Video ID'),
            'author_id' => Yii::t('ru', 'Author ID'),
        ];
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getVideo($id) {
        return Video::findOne(['id' => $id]);
    }

    /**
     * 
     * @return array
     */
    public static function get_model() {
        return self::find()->where(['author_id' => Yii::$app->user->id])->asArray()->all();
    }

    /**
     * 
     * @return array
     */
    public static function get_count() {
        return self::find()->where(['author_id' => Yii::$app->user->id])->count();
    }

    /**
     * Обнулить счетчик комментариев
     * @param type $id
     */
    public function setReset($id) {
        $comments_clock = self::findOne(['author_id' => Yii::$app->user->id, 'video_id' => $id]);

        if ($comments_clock != NULL) {
            $comments_clock->delete();
        }
    }

}
