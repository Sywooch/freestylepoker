<?php

namespace nill\bankroll\models;

use vova07\fileapi\behaviors\UploadBehavior;
use nill\bankroll\traits\ModuleTrait;
use Yii;

/**
 * This is the model class for table "{{%bankroll}}".
 *
 * @property integer $id
 * @property integer $img
 * @property integer $text
 * @property integer $lot
 * @property integer $link
 */
class Bankroll extends \yii\db\ActiveRecord {

    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%bankroll}}';
    }

    public function behaviors() {
        return [
            /*
             * UploadBehavior for widget "FileAPIUpload"
             */
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'img' => [
                        'path' => $this->module->imagePath,
                        'tempPath' => $this->module->imagesTempPath,
                        'url' => $this->module->imageUrl
                    ],
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['img', 'text', 'lot', 'link'], 'required'],
            [['lot', 'link', 'text', 'img'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'text' => 'Text',
            'lot' => 'Lot',
            'link' => 'Link',
        ];
    }

    /*
     * Method for get Slides from DataBase
     * @return array value Slides
     */

    public static function getBlocks() {
        return self::find()
                        ->asArray()
                        ->orderBy(['id' => SORT_ASC])
                        ->all();
    }

}
