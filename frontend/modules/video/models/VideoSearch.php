<?php

namespace app\modules\video\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\video\models\Video;
use yii\helpers\ArrayHelper;

/**
 * VideoSearch represents the model behind the search form about `app\modules\video\models\Video`.
 */
class VideoSearch extends Video {

    /**
     * @inheritdoc
     */
    public $from_val;
    public $to_val;
    public $is_buy;
    public $is_parsed;

    public function rules() {
        return [
            [['title', 'author_id', 'from_val', 'to_val', 'val', 'is_buy', 'is_parsed', 'tags'], 'string'],
            [['embed', 'description'], 'safe'],
        ];
    }

    public function attributeLabels() {
        parent::attributeLabels();
        return [
            'from_val' => Yii::t('ru', 'From F$P'),
            'to_val' => Yii::t('ru', 'To F$P'),
            'is_buy' => Yii::t('ru', 'Is Buy'),
            'is_parsed' => Yii::t('ru', 'Is Parsed'),
            'author' => Yii::t('ru', 'Author'),
            'title' => Yii::t('ru', 'Search'),
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {

        // COOKIES SET
        if (!empty(Yii::$app->request->get('page_size'))) {
            \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'VIDEO_PAGE_SIZE',
                'value' => Yii::$app->request->get('page_size'),
            ]));
        }

        // COOKIES GET
        if (($cookie = \Yii::$app->request->cookies->get('VIDEO_PAGE_SIZE')) !== null) {
            $cookie_page_size = $cookie->value;
        }
        if (!empty(Yii::$app->request->get('page_size'))) {
            $cookie_page_size = Yii::$app->request->get('page_size');
        }

        $query = Video::find()->joinWith('user');
        //->joinWith(['videoUsr'])->where(['user_id'=>Yii::$app->user->id]);
        //->with(['videoUsr']);
//        
//        $query = User::find()
//                ->innerJoinWith('video');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => (!empty($cookie_page_size)) ? $cookie_page_size : 2,
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->orFilterWhere(['like', 'description', $this->title])
                ->orFilterWhere(['like', 'tags', $this->title])
                ->andFilterWhere(['like', 'author_id', $this->author_id])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'tags', $this->tags])
                ->andFilterWhere(['between', 'val', $this->from_val, $this->to_val]);

        if ($this->is_buy && !Yii::$app->user->isGuest) {
            $query->joinWith(['videoUsr'])->andFilterWhere([VideoUsr::tableName() . '.user_id' => Yii::$app->user->id]);
            $query->joinWith(['trainingsUsr'])->orFilterWhere([\app\modules\trainings\models\TrainingsUsr::tableName() . '.user_id' => Yii::$app->user->id]);
        }

        if ($this->is_parsed && !Yii::$app->user->isGuest) {
            //$query->joinWith(['videoon'])->andFilterWhere(['{{%video_on}}.user_id' => Yii::$app->user->id]);
            $query->joinWith(['videoparsed'])->andFilterWhere([Videoparsed::tableName() . '.user_id' => Yii::$app->user->id]);
        }

        return $dataProvider;
    }

    public function getAuthors() {
        $query = Video::find()
                        ->joinWith('user')
                        ->orderBy([\nill\users\models\User::tableName() . '.username' => SORT_ASC])->asArray()->all();

        $result = ArrayHelper::map($query, 'author_id', 'user.username');
        return $result;
    }

}
