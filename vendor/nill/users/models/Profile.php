<?php

namespace nill\users\models;

use vova07\fileapi\behaviors\UploadBehavior;
use nill\users\Module;
use nill\users\traits\ModuleTrait;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class Profile
 * @package nill\users\models
 * User profile model.
 *
 * @property integer $user_id User ID
 * @property string $name Name
 * @property string $surname Surname
 *
 * @property User $user User
 */
class Profile extends ActiveRecord
{
    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profiles}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'avatar_url' => [
                        'path' => $this->module->avatarPath,
                        'tempPath' => $this->module->avatarsTempPath,
                        'url' => $this->module->avatarUrl
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findByUserId($id)
    {
        return static::findOne(['user_id' => $id]);
    }

    /**
     * @return string User full name
     */
    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Name
            ['name', 'match', 'pattern' => Module::getInstance()->patternName],
            // Surname
            ['surname', 'match', 'pattern' => Module::getInstance()->patternSurname]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Module::t('users', 'ATTR_NAME'),
            'surname' => Module::t('users', 'ATTR_SURNAME')
        ];
    }

    /**
     * @return Profile|null Profile user
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('profile');
    }
}
