<?php

namespace nill\fsp\models\frontend;

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
class Giftstat extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'fsp_stat_gift';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['from_id', 'to_id', 'comment', 'date'], 'required'],
            [['from_id', 'to_id', 'target_id', 'group_id', 'category'], 'integer'],
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
            'from_id' => Yii::t('ru', 'User ID'),
            'to_id' => Yii::t('ru', 'Fsp'),
            'comment' => Yii::t('ru', 'Comment'),
            'date' => Yii::t('ru', 'Date'),
            'target_id' => Yii::t('ru', 'Target_id'),
            'group_id' => Yii::t('ru', 'Group_id'),
            'category' => Yii::t('ru', 'Category'),
        ];
    }

    /**
     * 
     * @return string
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['change-gold'] = [
            'from_id',
            'to_id',
            'comment',
            'date',
            'target_id',
            'group_id',
            'category',
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
        return $this->hasOne(User::className(), ['id' => 'from_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'to_id']);
    }
    
    /**
     * Обновление статистики дарения
     * @param type $to_id
     * @param type $target_id
     */
    public function gift_stat_update($to_id, $target_id, $comment, $category, $group) {
        $this->from_id = Yii::$app->user->id;
        $this->to_id = $to_id;
        $this->target_id = $target_id;
        $this->category = $category;
        $this->group_id = $group;
        $this->comment = $comment;
        $this->date = Yii::$app->formatter->asTimestamp('now');
        $this->save();
    }
}
