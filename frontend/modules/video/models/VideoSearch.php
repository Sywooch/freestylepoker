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
    public $val1;
    public $val2;
    public $cup;
    public $ons;

    public function rules() {
        return [
            [['title', 'author', 'val1', 'val2', 'val', 'cup', 'ons','tags'], 'string'],
            [['embed', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {

            $query = Video::find();
            //->joinWith(['videoUsr'])->where(['user_id'=>Yii::$app->user->id]);
            //->with(['videoUsr']);
//        
//        $query = User::find()
//                ->innerJoinWith('video');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'author', $this->author])
                ->andFilterWhere(['like', 'tags', $this->tags])
                ->andFilterWhere(['between', 'val', $this->val1, $this->val2]);

        if ($this->cup && !Yii::$app->user->isGuest) {
            $query->joinWith(['videoUsr'])->andFilterWhere([VideoUsr::tableName().'.user_id' => Yii::$app->user->id]);
        }
        
        if ($this->ons && !Yii::$app->user->isGuest) {
            //$query->joinWith(['videoon'])->andFilterWhere(['{{%video_on}}.user_id' => Yii::$app->user->id]);
            $query->joinWith(['videoon'])->andFilterWhere([Videoon::tableName().'.user_id' => Yii::$app->user->id]);
        }

        return $dataProvider;
    }

    public function getAuthors() {
        $query = Video::find()->orderBy(['author' => SORT_ASC])->asArray()->all();
        $a = ['' => 'Select...'];
        $b = ArrayHelper::map($query, 'author', 'author');
        $result = ArrayHelper::merge($a, $b);
        return $result;
    }

}
