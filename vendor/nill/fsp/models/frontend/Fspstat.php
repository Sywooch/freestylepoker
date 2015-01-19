<?php

namespace nill\fsp\models\frontend;

use Yii;
use nill\users\models\backend\User;

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

    public $cancel;
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
            [['user_id', 'fsp', 'comment', 'date'], 'required'],
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
     * Обновить статистику при покупке или отмене
     * @param type $val
     * @param type $target_id
     * @param type $comment
     */
    public function stat_update($val, $target_id, $comment, $group) {
        $this->fsp = $val;
        $this->user_id = Yii::$app->user->id;
        $this->target_id = $target_id;
        $this->group_id = $group;
        $this->comment = $comment;
        $this->date = Yii::$app->formatter->asTimestamp('now');
        $this->save();
    }
}
