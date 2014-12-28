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
            [['title', 'embed', 'author_id', 'section', 'alias', 'date', 'type_id', 'duration', 'preview', 'comments', 'gp', 'author'], 'required'],
            [['description', 'conspects', 'tags'], 'string'],
            [['val', 'author_id', 'section', 'duration', 'id_training', 'type_id', 'limit_id', 'comments', 'gp'], 'integer'],
            [['date'], 'safe'],
            [['title', 'ids'], 'string', 'max' => 128],
            [['embed', 'alias', 'password', 'preview'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'title' => Yii::t('ru', 'Title'),
            'embed' => Yii::t('ru', 'Embed'),
            'description' => Yii::t('ru', 'Description'),
            'val' => Yii::t('ru', 'Val'),
            'author_id' => Yii::t('ru', 'Author ID'),
            'author' => Yii::t('ru', 'Author'),
            'section' => Yii::t('ru', 'Section'),
            'alias' => Yii::t('ru', 'Alias'),
            'ids' => Yii::t('ru', 'Ids'),
            'date' => Yii::t('ru', 'Date'),
            'duration' => Yii::t('ru', 'Duration'),
            'conspects' => Yii::t('ru', 'Conspects'),
            'id_training' => Yii::t('ru', 'Id Training'),
            'password' => Yii::t('ru', 'Password'),
            'type_id' => Yii::t('ru', 'Type ID'),
            'limit_id' => Yii::t('ru', 'Limit ID'),
            'tags' => Yii::t('ru', 'Tags'),
            'preview' => Yii::t('ru', 'Preview'),
            'comments' => Yii::t('ru', 'Comments'),
            'gp' => Yii::t('ru', 'Gp'),
            'val1' => Yii::t('ru', 'val1'),
            'val2' => Yii::t('ru', 'val2'),
            'cup' => Yii::t('ru', 'cup'),
            'ons' => Yii::t('ru', 'ons'),
        ];
    }

    /**
     * 
     * @return string
     */
    public function scenarios() {
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

        if ($if_buy_video === NULL) {
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
        } else {
            throw new UserException('Ошибка, Вы не авторизированы');
        }
    }

    /**
     * 
     * @return type
     */
    public function getVideoUsr() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasMany(VideoUsr::className(), ['video_id' => 'id']);
    }

    /**
     * 
     * @return type
     */
    public function getVideoon() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasMany(Videoon::className(), ['video_id' => 'id']);
    }

    /**
     * 
     * @return type
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

}
