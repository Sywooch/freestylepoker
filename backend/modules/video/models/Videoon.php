<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "{{%video_on}}".
 *
 * @property integer $id
 * @property integer $video_id
 * @property integer $user_id
 */
class Videoon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_on}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'user_id'], 'required'],
            [['video_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'video_id' => Yii::t('ru', 'Video ID'),
            'user_id' => Yii::t('ru', 'User ID'),
        ];
    }
}
