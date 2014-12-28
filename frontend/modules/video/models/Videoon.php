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
class Videoon extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%video_on}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['video_id', 'user_id'], 'required'],
            [['video_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'video_id' => Yii::t('ru', 'Video ID'),
            'user_id' => Yii::t('ru', 'User ID'),
        ];
    }

    /**
     * Pjax add VIDEO ON
     * @param type $id
     * @return string
     */
    public function on($id) {
        // Создаем экземпляр модели Видео-Пользователь
        $videoon = new Videoon();

        // Присваевам атрибуты и сохраняем (делаем запись)
        $videoon->video_id = $id;
        $videoon->user_id = Yii::$app->user->id;
        $videoon->save();
        return 'Разобрано';
    }

    /**
     * Pjax add VIDEO DELETE
     * @param type $id
     * @return string
     */
    public function ons($id) {
        $videoon = Videoon::findOne(['video_id' => $id, 'user_id' => Yii::$app->user->id]);
        if ($videoon != NULL) {
            $videoon->delete();
            return 'Отмечено не разобраным';
        }
        else {
            return 'Не правильно';
        }
    }

}
