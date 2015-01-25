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
class RoomsAcc extends \yii\db\ActiveRecord {

    const ACC_STAT = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%rooms_acc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['room_id', 'user_id', 'status_id', 'nickname'], 'required'],
            [['room_id', 'user_id', 'status_id', 'date'], 'integer'],
            [['nickname'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'room_id' => Yii::t('ru', 'Room ID'),
            'user_id' => Yii::t('ru', 'User ID'),
            'status_id' => Yii::t('ru', 'Status ID'),
            'nickname' => Yii::t('ru', 'Nickname'),
            'date' => Yii::t('ru', 'Date'),
        ];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        return $this->date = Yii::$app->formatter->asTimestamp(date('d.m.Y'));
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        if ($this->status_id == self::ACC_STAT) {
            $user = User::findOne(['id' => $this->user_id]);
            $message = Yii::t('ru', 'Congratulations! Your account approved');
            return $this->request_send($user->email, $message);
        }
        else {
            $message = Yii::t('ru', 'REQUEST on registration in poker-room');
            return $this->request_send(Yii::$app->params['adminEmail'], $message);
        }
    }

    public function afterDelete() {
        parent::afterDelete();

        $user = User::findOne(['id' => $this->user_id]);
        $message = Yii::t('ru', 'Sorry, your account is not approved');
        return $this->request_send($user->email, $message);
    }

    /**
     * request_send
     * @param type $email
     */
    public function request_send($email, $message) {
        Yii::$app->mail->compose()
                ->setTo($email)
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setSubject(Yii::t('ru', 'Freestylepoker - request on account of poker-room'))
                ->setTextBody($message)
                ->send();
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
