<?php

namespace app\modules\rooms\models;

use Yii;
use nill\users\models\backend\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%rooms_acc}}".
 *
 * @property integer $id
 * @property integer $room_id
 * @property integer $user_id
 * @property integer $status_id
 * @property string $nickname
 */
class RoomsAcc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rooms_acc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'user_id', 'status_id', 'nickname'], 'required'],
            [['room_id', 'user_id', 'status_id'], 'integer'],
            [['nickname'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'room_id' => Yii::t('ru', 'Room ID'),
            'user_id' => Yii::t('ru', 'User ID'),
            'status_id' => Yii::t('ru', 'Status ID'),
            'nickname' => Yii::t('ru', 'Nickname'),
        ];
    }
    
    /**
     * Связь пользователь
     * @return type
     */
    public function getUser() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * Связь рум
     * @return type
     */
    public function getRoom() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }
    
    /**
     * Получить список всех пользователей для вывода в форме
     * @return array
     */
    public function getAllUsers() {
        $model = User::find()->asArray()->all();
        $result = ArrayHelper::map($model, 'id', 'username');
        return $result;
    }
    
    /**
     * Получить список всех пользователей для вывода в форме
     * @return array
     */
    public function getAllRooms() {
        $model = Rooms::find()->asArray()->all();
        $result = ArrayHelper::map($model, 'id', 'title');
        return $result;
    }
}
