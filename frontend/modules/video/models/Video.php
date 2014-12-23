<?php

namespace app\modules\video\models;

use nill\users\models\User;
use Yii;
use yii\base\UserException;
use app\modules\video\models\VideoUsr;

/**
 * This is the model class for table "yii2_start_video".
 *
 * @property integer $id
 * @property string $embed
 * @property string $description
 */
class Video extends \yii\db\ActiveRecord {

    public $message;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'embed', 'description', 'author_id'], 'required'],
            [['val'], 'integer'],
            [['val'], 'number'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['embed'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
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
            'author_id',
        ];
        $scenarios['admin-update'] = [
            'title',
            'embed',
            'val',
            'description',
            'author_id',
        ];

        return $scenarios;
    }

    /**
     * 
     * @param type $id
     * @return boolean
     * 
     * Функция проверяет было ли видео уже куплено пользователем
     */
    public function getIsBuy($id) {

        $if_buy_video = VideoUsr::findOne(['video_id' => $id, 'user_id' => Yii::$app->user->id]);

        if ($if_buy_video===NULL) {
            return false;
        } else {
            return true;
        }
    }

    public function buy($id) {
        // Проверка авторизации
        if (!Yii::$app->user->isGuest) {

            // Проверка было ли видео куплено ранее
            $isBuy = $this->getisBuy($id);
            if ($isBuy === false) {

                // Определяем стоимость видео
                $val = self::findOne($id)->val;

                // Получаем Модель и сумму пользователя
                $user = User::findOne(Yii::$app->user->id);
                $gold = $user->gold;

                // Если сумма больше или равна стоимости
                if ($gold >= $val) {

                    // Вычитаем
                    $buy = $gold - $val;

                    // Создаем экземпляр модели Видео-Пользователь
                    $videousr = new VideoUsr();

                    // Присваевам атрибуты и сохраняем (делаем запись)
                    $videousr->video_id = $id;
                    $videousr->user_id = Yii::$app->user->id;
                    $videousr->save();

                    // Получаем запись из модели текущего пользователя
                    // Присваевам резултат вычитания полю gold
                    $user->gold = $buy;
                    $user->save();

                    return $this->message = 'Ваш пароль: 43Xs12fkGbt4Fu';
                } else {
                    return $this->message = 'Недостаточно F$P';
                }
            } else {
                throw new UserException('Ошибка, видео уже куплено');
            }
        }
    }
     
    /**
     * 
     * @return type
     */
    public function getVideoUsr()
    {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasMany(VideoUsr::className(), ['video_id' => 'id']);
    }
    
    /**
     * 
     * @return type
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}
