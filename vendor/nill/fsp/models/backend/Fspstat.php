<?php

namespace nill\fsp\models\backend;

use Yii;

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
class Fspstat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fsp_stat_fsp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'fsp', 'from_id', 'comment', 'date'], 'required'],
            [['user_id', 'fsp', 'from_id'], 'integer'],
            [['date'], 'safe'],
            [['comment'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ru', 'ID'),
            'user_id' => Yii::t('ru', 'User ID'),
            'fsp' => Yii::t('ru', 'Fsp'),
            'from_id' => Yii::t('ru', 'From ID'),
            'comment' => Yii::t('ru', 'Comment'),
            'date' => Yii::t('ru', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom()
    {
        return $this->hasOne(Users::className(), ['id' => 'from_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
