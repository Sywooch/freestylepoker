<?php

namespace app\modules\video\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\video\models\Video;
use yii\helpers\ArrayHelper;
use app\modules\trainings\models\TrainingsUsr;

/**
 * VideoSearch represents the model behind the search form about `app\modules\video\models\Video`.
 */
class VideoSearch extends Video {

    /**
     * @inheritdoc
     */
    public $from_val;
    public $to_val;
    public $no_val;
    public $is_buy;
    public $is_not_buy;
    public $is_parsed;
    public $is_not_parsed;
    public $limit_from;
    public $limit_to;

    public function rules() {
        return [
            [['title', 'limit_from', 'limit_to', 'author_id', 'from_val', 'type_id', 'to_val', 'no_val', 'val', 'is_buy', 'is_not_buy', 'is_parsed', 'is_not_parsed', 'tags'], 'string'],
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
            'no_val' => Yii::t('ru', 'Free'),
            'is_not_buy' => Yii::t('ru', 'Not buyed'),
            'is_not_parsed' => Yii::t('ru', 'Not parsed'),
            'limit_from' => Yii::t('ru', 'From Limit'),
            'limit_to' => Yii::t('ru', 'To Limit'),
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

        if (isset($params['author'])) {
            if (!isset($params['VideoSearch'])) {
                $params['VideoSearch'] = array();
            }
            $params['VideoSearch']['author_id'] = $params['author'];
            unset($params['author']);
        }

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

        if ($this->no_val && !Yii::$app->user->isGuest) {
            $query->andWhere(['val' => NULL]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])
                ->orFilterWhere(['like', 'description', $this->title])
                ->orFilterWhere(['like', 'tags', $this->title])
                ->andFilterWhere(['like', 'author_id', $this->author_id])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'tags', $this->tags])
                ->andFilterWhere(['between', 'val', $this->from_val, $this->to_val])
                ->andFilterWhere(['like', Video::tableName() . '.type_id', $this->type_id]);

        if ($this->limit_to && $this->limit_from) {
            $query->joinWith(['limit'])
                    ->andFilterWhere(['between', VideoLimits::tableName() . '.sortOrder', $this->limit_from, $this->limit_to]);
        }

        if ($this->is_buy && !Yii::$app->user->isGuest) {
            $query->joinWith(['videoUsr'])->orFilterWhere([VideoUsr::tableName() . '.user_id' => Yii::$app->user->id]);
            $query->joinWith(['trainingsUsr'])->orFilterWhere([\app\modules\trainings\models\TrainingsUsr::tableName() . '.user_id' => Yii::$app->user->id]);
            if ($this->no_val) {
                $query->orWhere(['val' => NULL]);
            }
        }

//        SELECT * FROM fsp_core_video v
//LEFT JOIN fsp_core_video_usr vu on v.id = vu.video_id and vu.user_id = 5
//LEFT JOIN fsp_core_trainings_usr tu on v.id_training = tu.training_id and tu.user_id = 5
//WHERE vu.id is null and tu.id is null

        if ($this->is_not_buy && !Yii::$app->user->isGuest) {

            $query->leftJoin(VideoUsr::tableName(), [
                        VideoUsr::tableName() . '.video_id ' => new \yii\db\Expression(Video::tableName() . '.id'),
                        VideoUsr::tableName() . '.user_id' => Yii::$app->user->id])
                    ->leftJoin(TrainingsUsr::tableName(), [
                        TrainingsUsr::tableName() . '.training_id ' => new \yii\db\Expression(Video::tableName() . '.id_training'),
                        TrainingsUsr::tableName() . '.user_id' => Yii::$app->user->id])
                    ->where([VideoUsr::tableName() . '.id' => NULL])
                    ->andwhere([TrainingsUsr::tableName() . '.id' => NULL])
                    ->andWhere(['!=', Video::tableName() . '.val', 'NULL']);
            // ->andWhere([Video::tableName() . '.val' => 120]);
        }

        if ($this->is_parsed && !Yii::$app->user->isGuest) {
            //$query->joinWith(['videoon'])->andFilterWhere(['{{%video_on}}.user_id' => Yii::$app->user->id]);
            $query->joinWith(['videoparsed'])->andFilterWhere([Videoparsed::tableName() . '.user_id' => Yii::$app->user->id]);
        }

        if ($this->is_not_parsed && !Yii::$app->user->isGuest) {
            $query->leftJoin(Videoparsed::tableName(), [
                        Videoparsed::tableName() . '.video_id ' => new \yii\db\Expression(Video::tableName() . '.id'),
                        Videoparsed::tableName() . '.user_id' => Yii::$app->user->id])
                    ->andwhere([Videoparsed::tableName() . '.id' => NULL]);
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
