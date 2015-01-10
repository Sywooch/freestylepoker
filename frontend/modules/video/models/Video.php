<?php

namespace app\modules\video\models;

use nill\users\models\User;
use Yii;
use yii\base\UserException;
use app\modules\video\models\VideoUsr;
use vova07\comments\models\Comment;
use yii\helpers\ArrayHelper;
use app\modules\video\models\VideoRating;

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
            [['val', 'author_id', 'section', 'duration', 'id_training', 'type_id', 'limit_id', 'comments', 'gp', 'rating'], 'integer'],
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
            'rating' => Yii::t('ru', 'Gp'),
            'videoparsed.id' => Yii::t('ru', 'Parsed'),
        ];
    }

    /**
     * 
     * @param type $id
     * @return boolean
     * 
     * Функция проверяет было ли видео уже куплено пользователем
     */
    public function get_isBuy() {

        $if_buy_video = VideoUsr::findOne(['video_id' => $this->id, 'user_id' => Yii::$app->user->id]);

        if ($if_buy_video === NULL) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Покупка видео
     * @param type $id
     * @return type
     * @throws UserException
     */
    public function buy() {
        $id = $this->id;
        // Проверка авторизации
        if (!Yii::$app->user->isGuest) {

            // Проверка было ли видео куплено ранее
            if ($this->_isBuy === false) {

                // Определяем стоимость видео
                $video_model = self::findOne($id);
                $val = $video_model->val;

                // Получаем Модель и сумму пользователя
                $user = User::findOne(Yii::$app->user->id);
                $gold = $user->gold;

                // Если сумма больше или равна стоимости
                // покупка осуществляется
                if ($gold >= $val) {

                    // Вычитаем
                    $buy = $gold - $val;

                    // Создаем экземпляр модели Видео-Пользователь
                    $videousr = new VideoUsr();

                    // Присваевам атрибуты и сохраняем (делаем запись)
                    $videousr->video_id = $id;
                    $videousr->user_id = Yii::$app->user->id;
                    $videousr->save();

                    // Обновляем атрибут gold и присваиваем результат вычитания
                    $user->updateAttributes(['gold' => $buy]);

                    // Обновляем статистику
                    $stat = new \nill\fsp\models\frontend\Fspstat;
                    $stat->fsp = -$val;
                    $stat->user_id = Yii::$app->user->id;
                    $stat->comment = $video_model->ids != NULL || $video_model->ids != '' ? 'Купил видео курс id: ' . $id : 'Купил видео id: ' . $id;
                    $stat->date = Yii::$app->formatter->asTimestamp('now');
                    $stat->save();

                    // Покупка курса
                    if ($video_model->ids != NULL || $video_model->ids != '') {
                        $this->buy_course($video_model->ids);
                    }

                    return $this->message = 'Ваш пароль: ' . $this->password;
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
     * Покупка курса видео
     * @param type $ids
     */
    private function buy_course($ids) {
        $buy_course = explode(",", $ids);
        foreach ($buy_course as $value) {
            if ($value != NULL) {
                // Создаем экземпляр модели Видео-Пользователь
                $videousr = new VideoUsr();

                // Присваевам атрибуты и сохраняем (делаем запись)
                $videousr->video_id = $value;
                $videousr->user_id = Yii::$app->user->id;
                $videousr->save();
            }
        }
    }

    /**
     * Получить кол-во комментариев в записи
     * @param type $id
     * @return integer
     */
    public function getCommentsCount() {
        $comments_count = Comment::find()->where(['model_class' => '2621821478', 'model_id' => $this->id])->count();
        return $comments_count;
    }

    /**
     * Получить дату в формате
     * @return date
     */
    public function get_date() {
        return Yii::$app->formatter->asDate($this->date);
    }

    /**
     * Вернуть - разобрано ли видео?
     * @return object or NULL
     */
    public function get_isParsed() {
        return Videoparsed::findOne(['video_id' => $this->id, 'user_id' => Yii::$app->user->id]);
    }
    
    /**
     * Вернуть - проголосовал ли пользователь?
     * @return object or NULL
     */
    public function get_isRating() {
        return VideoRating::findOne(['video_id' => $this->id, 'user_id' => Yii::$app->user->id]);
    }

    /**
     * Связь видео-пользователь
     * @return type
     */
    public function getVideoUsr() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasMany(VideoUsr::className(), ['video_id' => 'id']);
    }

    /**
     * Связь разобранно
     * @return type
     */
    public function getVideoparsed() {
        // VideoUsr has_many Video via Video.video_id -> id
        return $this->hasOne(Videoparsed::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimit() {
        return $this->hasOne(VideoLimits::className(), ['id' => 'limit_id']);
    }

    /**
     * 
     * @param type $value
     * @return \yii\db\ActiveQuery
     */
    public function getvideomodel($value) {
        return self::findOne($value);
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

    public static function _gift($request) {

        // Создаем экземпляр модели Видео-Пользователь
        $videousr = new VideoUsr();
        $isset_videousr = $videousr->findOne(['video_id' => $request['id'], 'user_id' => $request['author']]);

        if ($isset_videousr === NULL) {
            // Присваевам атрибуты и сохраняем (делаем запись)
            $videousr->video_id = $request['id'];
            $videousr->user_id = $request['author'];
            $videousr->save();

            // Обновляем статистику
            $stat = new \nill\fsp\models\frontend\Giftstat;
            $stat->from_id = Yii::$app->user->id;
            $stat->to_id = $request['author'];
            $stat->comment = 'Видео подарено, id: ' . $request['id'];
            $stat->date = Yii::$app->formatter->asTimestamp('now');
            $stat->save();

            return 'Успешно подарено';
        } else {
            return 'Видео уже у пользователя';
        }
    }

//    /**
//     * 
//     * @return type
//     */
//    public function getUser() {
//        return $this->hasOne(User::className(), ['id' => 'author_id']);
//    }
}
