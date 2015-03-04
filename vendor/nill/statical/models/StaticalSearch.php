<?php

namespace nill\statical\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use nill\statical\models\Statical;

/**
 * StaticalSearch represents the model behind the search form about `app\modules\rooms\models\Statical`.
 */
class StaticalSearch extends Statical
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['text'], 'string']
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
        $query = Statical::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'text' => $this->text,
        ]);

        return $dataProvider;
    }
}
