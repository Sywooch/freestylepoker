<?php

namespace nill\fsp\models\backend;

use Yii;
use nill\users\models\backend\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "fsp_stat_fsp".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $fsp
 * @property integer $from_id
 * @property string $comment
 * @property string $date
 *
 * @property Users $from
 * @property Users $user
 */
class Fspstat extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'fsp_stat_fsp';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'fsp', 'comment'], 'required'],
            [['user_id', 'fsp', 'target_id', 'group_id'], 'integer'],
            [['date'], 'safe'],
            [['comment'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'user_id' => Yii::t('ru', 'User ID'),
            'fsp' => Yii::t('ru', 'Fsp'),
            'comment' => Yii::t('ru', 'Comment'),
            'date' => Yii::t('ru', 'Date'),
            'target_id' => Yii::t('ru', 'Target_id'),
            'group_id' => Yii::t('ru', 'Group_id'),
        ];
    }

    /**
     * 
     * @return string
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['change-gold'] = [
            'user_id',
            'fsp',
            'comment',
            'date',
            'target_id',
            'group_id',
        ];
        return $scenarios;
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        // установить правильный формат даты
        return $this->date = Yii::$app->formatter->asTimestamp('now');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom() {
        return $this->hasOne(Users::className(), ['id' => 'from_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
     * 
     * @param type $insert
     * @param type $changedAttributes
     * @return \yii\db\ActiveQuery
     */
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        // Обновление счета пользователя
        $user = User::findOne(['id' => $this->user_id]);
        $gold = $user->getAttribute('gold');
        $sum = $this->fsp + $gold;
        $user->updateAttributes(['gold' => $sum]);
        return;
    }

    public static function month() {
        $month[1] = "Январь";
        $month[2] = "Февраль";
        $month[3] = "Март";
        $month[4] = "Апрель";
        $month[5] = "Май";
        $month[6] = "Июнь";
        $month[7] = "Июль";
        $month[8] = "Август";
        $month[9] = "Сентябрь";
        $month[10] = "Октябрь";
        $month[11] = "Ноябрь";
        $month[12] = "Декабрь";
        
        return $month;
    }

}
