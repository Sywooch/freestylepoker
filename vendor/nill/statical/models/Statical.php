<?php

namespace nill\statical\models;

use nill\statical\traits\ModuleTrait;
use Yii;

/**
 * This is the model class for table "{{%statical}}".
 *
 * @property integer $id
 * @property integer $text
 */
class Statical extends \yii\db\ActiveRecord {

    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%statical}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['text'], 'required'],
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'text' => 'Text',
        ];
    }

}
