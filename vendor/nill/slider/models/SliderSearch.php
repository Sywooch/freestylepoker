<?php

namespace nill\slider\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use nill\slider\models\Slider;

/**
 * SliderSearch represents the model behind the search form about `app\models\Slider`.
 */
class SliderSearch extends Slider
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['h1', 'h2', 'h3', 'align', 'img'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Slider::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'h2', $this->h2])
            ->andFilterWhere(['like', 'h3', $this->h3])
            ->andFilterWhere(['like', 'align', $this->align])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
