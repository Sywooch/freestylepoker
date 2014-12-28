<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "{{%video_limits}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type_id
 *
 * @property Video[] $videos
 * @property VideoType $type
 */
class VideoLimits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_limits}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type_id'], 'required'],
            [['type_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['type_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'name' => Yii::t('ru', 'Name'),
            'type_id' => Yii::t('ru', 'Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::className(), ['limit_id' => 'id'])->inverseOf('type');;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(VideoType::className(), ['id' => 'type_id']);
    }
}
