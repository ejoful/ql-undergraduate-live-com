<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Card;

/**
 * CardSearch represents the model behind the search form about `backend\models\Card`.
 */
class CardSearch extends Card
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'use_status', 'print_status', 'use_time', 'user_phone'], 'integer'],
            [['card_id', 'card_pass', 'create_time'], 'safe'],
            [['money'], 'number'],
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
        $query = Card::find()
        ->orderBy('id desc');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'money' => $this->money,
            'use_status' => $this->use_status,
            'print_status' => $this->print_status,
            'use_time' => $this->use_time,
            'user_phone' => $this->user_phone,
        ]);
        if ($this->create_time) {
            $query->andFilterWhere(['create_time' => strtotime($this->create_time)]);
        }
        $query->andFilterWhere(['like', 'card_id', $this->card_id])
            ->andFilterWhere(['like', 'card_pass', $this->card_pass]);

        return $dataProvider;
    }
}
