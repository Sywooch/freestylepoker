<?php

namespace app\modules\rooms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rooms\models\RoomsAcc;

/**
 * RoomsAccSearch represents the model behind the search form about `app\modules\rooms\models\RoomsAcc`.
 */
class RoomsAccSearch extends RoomsAcc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'user_id', 'status_id'], 'integer'],
            [['nickname'], 'safe'],
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
        $query = RoomsAcc::find()
                ->joinWith('user')
                ->joinWith('room');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'room_id' => $this->room_id,
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'nickname', $this->nickname]);

        return $dataProvider;
    }
}
