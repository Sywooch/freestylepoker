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
            [['from_id', 'to_id'], 'integer'],
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
        return $this->hasOne(User::className(), ['id' => 'to_id']);
    }
}
