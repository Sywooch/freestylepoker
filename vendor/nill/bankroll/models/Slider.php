<?php

namespace nill\slider\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;
use nill\slider\Module;
use nill\slider\traits\ModuleTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "$prefix_slider".
 *
 * @property integer $id
 * @property string $h1
 * @property string $h2
 * @property string $h3
 * @property string $align
 * @property string $img
 */
class Slider extends ActiveRecord
{
    /*
    * Implements `getModule` method, to receive current module instance.
    */
    use ModuleTrait;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }
    
    public function behaviors()
    {
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
    public function rules()
    {
        return [
            [['align', 'img'], 'required'],
            [['h1', 'h2', 'h3'], 'string'],
            [['align'], 'string', 'max' => 11],
            [['img'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'h1' => Module::t('slider', 'Title').' 1',
            'h2' => Module::t('slider', 'Title').' 2',
            'h3' => Module::t('slider', 'Title').' 3',
            'align' => Module::t('slider', 'Align'),
            'img' => Module::t('slider', 'Images'),
        ];
    }
    
    /*
    * Method for get align Slide
    * @return array value Align
    */
    public static function getAlign()
    {
        return [
            'left' => Module::t('slider', 'left'),
            'right' => Module::t('slider', 'right'),
            'center' => Module::t('slider', 'center'),
        ];
    }
    public function scenarios()
    {
        $scenarios['admin-create'] = [
            'id',
            'h1',
            'h2',
            'h3',
            'align',
            'img',
        ];
        $scenarios['admin-update'] = [
            'id',
            'h1',
            'h2',
            'h3',
            'align',
            'img',
        ];

        return $scenarios;
    }
    
    /*
    * Method for get Slides from DataBase
    * @return array value Slides
    */
    public static function getSliders() {
        return self::find()
            ->asArray()
            ->orderBy(['id'=>SORT_ASC])
            ->all();
    }
}
