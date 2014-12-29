<?php

namespace app\modules\video\models;

use Yii;
use yii\helpers\ArrayHelper;
use vova07\fileapi\behaviors\UploadBehavior;
use app\modules\video\traits\ModuleTrait;
use yii\behaviors\SluggableBehavior;
use himiklab\sortablegrid\SortableGridBehavior;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $embed
 * @property string $description
 * @property integer $val
 * @property integer $author_id
 * @property string $author
 * @property integer $section
 * @property string $alias
 * @property string $ids
 * @property string $date
 * @property integer $duration
 * @property string $conspects
 * @property integer $id_training
 * @property string $password
 * @property integer $type_id
 * @property integer $limit_id
 * @property string $tags
 * @property string $preview
 * @property integer $comments
 * @property integer $gp
 *
 * @property VideoType $type
 * @property VideoLimits $limit
 */
class Video extends \yii\db\ActiveRecord {

    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%video}}';
    }

    public function behaviors() {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'preview' => [
                        'path' => $this->module->previewPath,
                        'tempPath' => $this->module->imagesTempPath,
                        'url' => $this->module->previewUrl
                    ],
                ]
            ],
            'sluggableBehavior' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias'
            ],
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sortOrder'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'embed', 'section', 'date', 'type_id', 'duration', 'preview', 'comments', 'gp', 'author'], 'required'],
            [['description', 'conspects', 'tags'], 'string'],
            [['val', 'sortorder', 'author_id', 'section', 'duration', 'id_training', 'type_id', 'limit_id', 'comments', 'gp'], 'integer'],
            [['date'], 'safe'],
            [['title', 'ids'], 'string', 'max' => 128],
            [['embed', 'alias', 'password', 'preview'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('ru', 'ID'),
            'title' => Yii::t('ru', 'Title'),
            'embed' => Yii::t('ru', 'Embed'),
            'description' => Yii::t('ru', 'Description'),
            'val' => Yii::t('ru', 'Val'),
            'author_id' => Yii::t('ru', 'Author ID'),
            'author' => Yii::t('ru', 'Author'),
            'section' => Yii::t('ru', 'Section'),
            'alias' => Yii::t('ru', 'Alias'),
            'ids' => Yii::t('ru', 'Ids'),
            'date' => Yii::t('ru', 'Date'),
            'duration' => Yii::t('ru', 'Duration'),
            'conspects' => Yii::t('ru', 'Conspects'),
            'id_training' => Yii::t('ru', 'Id Training'),
            'password' => Yii::t('ru', 'Password'),
            'type_id' => Yii::t('ru', 'Type ID'),
            'limit_id' => Yii::t('ru', 'Limit ID'),
            'tags' => Yii::t('ru', 'Tags'),
            'preview' => Yii::t('ru', 'Preview'),
            'comments' => Yii::t('ru', 'Comments'),
            'gp' => Yii::t('ru', 'Gp'),
            'sortorder' => Yii::t('ru', 'sortOrder'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(VideoType::className(), ['id' => 'type_id'])->inverseOf('videos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimit() {
        return $this->hasOne(VideoLimits::className(), ['id' => 'limit_id'])->inverseOf('videos');
        ;
    }

    /**
     * 
     * @return string
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'title',
            'embed',
            'val',
            'description',
            'user_id',
            'author_id',
            'author',
            'section',
            'alias',
            'ids',
            'date',
            'duration',
            'conspects',
            'id_training',
            'password',
            'type_id',
            'limit_id',
            'tags',
            'preview',
            'comments',
            'gp',
            'sortorder',
        ];
        $scenarios['admin-update'] = [
            'title',
            'embed',
            'val',
            'description',
            'user_id',
            'author_id',
            'author',
            'section',
            'alias',
            'ids',
            'date',
            'duration',
            'conspects',
            'id_training',
            'password',
            'type_id',
            'limit_id',
            'tags',
            'preview',
            'comments',
            'gp',
            'sortorder',
        ];

        return $scenarios;
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        $this->date = Yii::$app->formatter->asTimestamp($this->date);

        return $this->author_id = Yii::$app->user->id;
    }

    /**
     * 
     * @return array
     */
    public function getTyper() {
        $models = VideoType::find()->asArray()->all();
        $result = ArrayHelper::map($models, 'id', 'name');
        return $result;
    }

    public function getData($cat_id) {
        $models = VideoLimits::find()->where(['type_id' => $cat_id])->asArray()->all();
        $b = ArrayHelper::map($models, 'id', 'name');
        return $b;
    }

    /**
     * 
     * @return array
     */
    public function getLimited($cat_id) {
        $models = VideoLimits::find()->where(['type_id' => $cat_id])->asArray()->all();
        foreach ($models as $key => $value) {
            $data[] = ['id' => $value['id'], 'name' => $value['name']];
        }
        return $data;
    }

    /**
     * 
     * @return type
     */
    public function getTags() {
        return [
            'Видеурок' => 'Видеурок',
            'Ключевые аспекты' => 'Ключевые аспекты',
            'bss' => 'bss',
            'mss' => 'mss'
        ];
//        if ($this->_permissions === null) {
//            $this->_permissions = Yii::$app->authManager->getPermissions();
//
//            if ($this->name !== null) {
//                unset($this->_permissions[$this->name]);
//            }
//        }
//        return $this->_permissions;
//        $permissionArray = ArrayHelper::map($model->permissions, 'name', 'name');
    }

}
