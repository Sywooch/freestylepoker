<?php

namespace app\modules\trainings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\trainings\models\Trainings;

/**
 * TrainingsSearch represents the model behind the search form about `app\modules\trainings\models\Trainings`.
 */
class TrainingsSearch extends Trainings {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'val', 'author_id', 'type_id', 'limit_id', 'time_start', 'time_end'], 'integer'],
            [['title', 'url', 'date', 'description', 'alias', 'password'], 'safe'],
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
        
        $query = Trainings::find()->published();
        
//        if (!($this->load($params) && $this->validate())) {
//            return $dataProvider;
//        }
        $this->load($params);
        
        if ($this->date != Null) {
            
            $date = Yii::$app->formatter->asTimestamp($this->date);
            $dater = explode(".", $this->date);
            
            $datetime = time();
            $daterx = date('t', $datetime);
            $dater[0];
            $x = $dater[0] + 6;
            $x = ($x > $daterx) ? 6 -($x - $daterx) : 6;
            $x = $dater[0] + $x;
            $date2 = date($x . '.'.$dater[1].'.2015');
            $date2 = Yii::$app->formatter->asTimestamp($date2);
            $query->andFilterWhere(['between', 'date', $date, $date2]);
            
        } else {
            if(Yii::$app->request->get('month')) {
                $month = Yii::$app->request->get('month');
            }
            else {
                $month = date('m');
            }
            $date = date('d.m.Y');
            $date = Yii::$app->formatter->asTimestamp($date);
            $x = date('d') + 6;
            $date2 = date($x . '.'.$month.'.2015');
            $date2 = Yii::$app->formatter->asTimestamp($date2);

            $query->andFilterWhere(['between', 'date', $date, $date2]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'val' => $this->val,
            'author_id' => $this->author_id,
            'type_id' => $this->type_id,
            'limit_id' => $this->limit_id,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'url', $this->url])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'alias', $this->alias])
                ->andFilterWhere(['like', 'password', $this->password]);      

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

}
