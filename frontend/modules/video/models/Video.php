<?php

namespace app\modules\video\models;

use nill\users\models\User;
use Yii;
use yii\base\UserException;
use app\modules\video\models\VideoUsr;
use vova07\comments\models\Comment;
use yii\helpers\ArrayHelper;
use app\modules\video\models\VideoRating;
use nill\fsp\models\frontend\Fspstat;
use nill\fsp\models\frontend\Giftstat;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "yii2_start_video".
 *
 * @property integer $id
 * @property string $embed
 * @property string $description
 */
class Video extends \yii\db\ActiveRecord {

    public $message;

    const GROUP_VIDEO = 1;
    const GIFT_CATEGORY = 1;
    const GIFT_CATEGORY_CANCELED = 0;

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
                $stat = new Fspstat();
                $stat->fsp = -$val;
                $stat->user_id = Yii::$app->user->id;
                $stat->target_id = $id;
                $stat->group_id = self::GROUP_VIDEO;
                $stat->comment = $video_model->ids != NULL || $video_model->ids != '' ? \Yii::t('ru', 'Video course is buyed: ') . $id : \Yii::t('ru', 'Video is buyed: ') . $id;
                $stat->date = Yii::$app->formatter->asTimestamp('now');
                $stat->save();

                // Покупка курса
                if ($video_model->ids != NULL || $video_model->ids != '') {
                    $this->buy_course($video_model->ids);
                }

                return $this->message = \Yii::t('ru', 'Successful buyed!');
            } else {
                return $this->message = \Yii::t('ru', 'Short of money!');
            }
        } else {
            throw new UserException(\Yii::t('ru', 'Error: this video is buyed!'));
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
     * Связь тренировка-пользователь
     * @return type
     */
//    public function getTrainingsUsr() {
//        // TrainingsUsr has_many Video via Video.video_id -> id
//        return $this->hasMany(TrainingsUsr::className(), ['video_id' => 'id']);
//    }

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

    /**
     * Подарить тренировку
     * @param type $request
     * @return string
     */
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
            $stat = new Giftstat();
            $stat->from_id = Yii::$app->user->id;
            $stat->to_id = $request['author'];
            $stat->target_id = $request['id'];
            $stat->category = self::GIFT_CATEGORY;
            $stat->group_id = self::GROUP_VIDEO;
            $stat->comment = \Yii::t('ru', 'Video as a gift: ') . $request['id'];
            $stat->date = Yii::$app->formatter->asTimestamp('now');
            $stat->save();

            // Дарение курса
            $video_model = self::findOne($request['id']);
            if ($video_model->ids != NULL || $video_model->ids != '') {
                self::gift_course($video_model->ids, $request['author']);
            }

            return \Yii::t('ru', 'Gift has been sent!');
        } else {
            return \Yii::t('ru', 'Gift canceled!');
        }
    }
    
    /**
     * Дарение курса видео
     * @param type $ids
     */
    private static function gift_course($ids, $user_id) {
        $buy_course = explode(",", $ids);
        foreach ($buy_course as $value) {
            if ($value != NULL) {
                // Создаем экземпляр модели Видео-Пользователь
                $videousr = new VideoUsr();

                // Присваевам атрибуты и сохраняем (делаем запись)
                $videousr->video_id = $value;
                $videousr->user_id = $user_id;
                $videousr->save();
            }
        }
    }

    /**
     * Отмена покупки видео
     * @param integer $id
     */
    public function _buy_cancel($id, $user_id) {

        // Находим запись Видео-Пользователь
        $videousr = VideoUsr::findOne(['video_id' => $id, 'user_id' => $user_id]);

        // Убедимся что видео было куплено
        if ($videousr) {
            $video_model = self::findOne($id);

            // Удаляем запись
            $videousr->delete();

            // Получаем Модель и сумму пользователя
            $user = User::findOne($user_id);
            $gold = $user->gold;

            // Получаем стоимость видео и возвращаем пользователю сумму
            $stat = new Fspstat();
            $stat_query = $stat->findOne(['target_id' => $id, 'user_id' => $user_id, 'group_id' => self::GROUP_VIDEO]);

            // Отмена сработает если сумма вычиталась
            if ($stat_query->fsp < 0) {

                $val = abs($stat_query->fsp);
                $sum = $val + $gold;

                $user->updateAttributes(['gold' => $sum]);

                // Обновляем статистику
                $stat->fsp = $val;
                $stat->user_id = $user_id;
                $stat->target_id = $id;
                $stat->group_id = self::GROUP_VIDEO;
                $stat->comment = $video_model->ids != NULL || $video_model->ids != '' ? \Yii::t('ru', 'Video course canceled: ') . $id : \Yii::t('ru', 'Video canceled: ') . $id;
                $stat->date = Yii::$app->formatter->asTimestamp('now');
                $stat->save();

                // Отмена курса
                if ($video_model->ids != NULL || $video_model->ids != '') {
                    $this->cancel_course($video_model->ids, $user_id);
                }
            } else {
                throw new UserException(\Yii::t('ru', 'Error'));
            }
        } else {
            throw new UserException(\Yii::t('ru', 'Error: This video was not buyed or buying was canceled before'));
        }
    }

    /**
     * Отмена курса видео
     * @param type $ids
     */
    private function cancel_course($ids, $user_id) {
        $buy_course = explode(",", $ids);
        foreach ($buy_course as $value) {
            if ($value != NULL) {
                // Находим запись Видео-Пользователь
                $videousr = VideoUsr::findOne(['video_id' => $value, 'user_id' => $user_id]);

                // Удаляем запись
                $videousr->delete();
            }
        }
    }

    /**
     * Отмена дарения видео
     * @param integer $id
     */
    public function _gift_cancel($id, $to_id) {

        // Находим запись Тренировка-Пользователь
        $videousr = VideoUsr::findOne(['video_id' => $id, 'user_id' => $to_id]);

        // Убедимся что видео подарено
        if ($videousr) {
            // Удаляем запись
            $videousr->delete();

            // Обновляем статистику
            $stat = new Giftstat();
            $stat->from_id = Yii::$app->user->id;
            $stat->to_id = $to_id;
            $stat->target_id = $id;
            $stat->category = self::GIFT_CATEGORY_CANCELED;
            $stat->group_id = self::GROUP_VIDEO;
            $stat->comment = \Yii::t('ru', 'Gift video canceled: ') . $id;
            $stat->date = Yii::$app->formatter->asTimestamp('now');
            $stat->save();

            // Отмена курса
            $video_model = self::findOne($id);
            if ($video_model->ids != NULL || $video_model->ids != '') {
                $this->cancel_course($video_model->ids, $to_id);
            }
        } else {
            throw new UserException(\Yii::t('ru', 'Error: Gift is not found or was canceled'));
        }
    }

    /**
     * Статистика о покупках видео
     * @param type $id
     * @return ActiveDataProvider
     */
    public function _stat($id) {
        $query = Fspstat::find()
                ->where(['target_id' => $id, 'group_id' => self::GROUP_VIDEO]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    /**
     * Статистика дарения видео
     * @param type $id
     * @return ActiveDataProvider
     */
    public function _stat_gift($id) {
        $query = Giftstat::find()
                ->where(['target_id' => $id, 'group_id' => self::GROUP_VIDEO]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

//    /**
//     * 
//     * @return type
//     */
//    public function getUser() {
//        return $this->hasOne(User::className(), ['id' => 'author_id']);
//    }
}
