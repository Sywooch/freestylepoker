<?php

namespace nill\bankroll\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use nill\bankroll\models\Bankroll;

/**
 * BankrollSearch represents the model behind the search form about `app\modules\rooms\models\Bankroll`.
 */
class BankrollSearch extends Bankroll
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'img', 'text', 'lot', 'link'], 'integer'],
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
        $query = Bankroll::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'img' => $this->img,
            'text' => $this->text,
            'lot' => $this->lot,
            'link' => $this->link,
        ]);

        return $dataProvider;
    }
}
