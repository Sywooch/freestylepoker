<?php

namespace nill\fsp\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use nill\fsp\models\backend\Fspstat;

/**
 * FspstatSearch represents the model behind the search form about `nill\fsp\models\backend\Fspstat`.
 */
class FspstatSearch extends Fspstat {

    public $sum;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'user_id', 'fsp', 'date', 'target_id', 'group_id'], 'integer'],
            [['comment'], 'safe'],
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
        $query = Fspstat::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->date) {
            $year = date('Y');
            $num = cal_days_in_month(CAL_GREGORIAN, $this->date, $year);

            $date1 = date('01.' . $this->date . '.' . $year);
            $date2 = date($num . '.' . $this->date . '.' . $year);
            $date1 = \Yii::$app->formatter->asTimestamp($date1);
            $date2 = \Yii::$app->formatter->asTimestamp($date2);

            $query->andFilterWhere(['between', 'date', $date1, $date2]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'fsp' => $this->fsp,
            //'date' => $this->date,
            'target_id' => $this->target_id,
            'group_id' => $this->group_id,
        ]);
        
        $sum = $query->asArray()->all();
        $x = 0;

        foreach ($sum as $key => $value) {
            if ($value['fsp'] < 0) {
                $x = $value['fsp'] + $x;
            }
        }
        
        $this->sum = $x;

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }

}
