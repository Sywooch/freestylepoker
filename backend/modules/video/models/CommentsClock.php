<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "{{%comments_clock}}".
 *
 * @property integer $video_id
 * @property integer $author_id
 */
class CommentsClock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comments_clock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'author_id'], 'required'],
            [['video_id', 'author_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'video_id' => Yii::t('ru', 'Video ID'),
            'author_id' => Yii::t('ru', 'Author ID'),
        ];
    }
}
