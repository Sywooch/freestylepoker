<?php

namespace app\modules\video\models;

use Yii;

/**
 * This is the model class for table "yii2_start_video".
 *
 * @property integer $id
 * @property string $embed
 * @property string $description
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'embed', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['embed'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'embed' => 'Embed',
            'description' => 'Description',
        ];
    }
}
