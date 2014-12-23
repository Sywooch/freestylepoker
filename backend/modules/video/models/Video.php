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
    //public $user_id;
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
            [['val'], 'integer'],
            [['val'], 'number'],
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
            'val' => 'F$P',
            'description' => 'Description',
        ];
    }
    
    /**
     * 
     * @return string
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'title',
            'embed',
            'val',
            'description',
            'user_id',
        ];
        $scenarios['admin-update'] = [
            'title',
            'embed',
            'val',
            'description',
            'user_id',
        ];

        return $scenarios;
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
        return $this->user_id=Yii::$app->user->id;     
    }
}
