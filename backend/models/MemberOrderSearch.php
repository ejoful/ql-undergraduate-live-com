<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MemberOrder;

/**
 * MemberOrderSearch represents the model behind the search form about `backend\models\MemberOrder`.
 */
class MemberOrderSearch extends MemberOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'order_status', 'pay_status', 'add_time', 'pay_time', 'invalid_time'], 'integer'],
            [['order_sn', 'consignee', 'mobile', 'email', 'pay_id', 'pay_name'], 'safe'],
            [['goods_amount', 'pay_fee', 'money_paid', 'order_amount', 'discount'], 'number'],
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
        $query = MemberOrder::find();

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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'order_status' => $this->order_status,
            'pay_status' => $this->pay_status,
            'goods_amount' => $this->goods_amount,
            'pay_fee' => $this->pay_fee,
            'money_paid' => $this->money_paid,
            'order_amount' => $this->order_amount,
            'add_time' => $this->add_time,
            'pay_time' => $this->pay_time,
            'discount' => $this->discount,
            'invalid_time' => $this->invalid_time,
        ]);

        $query->andFilterWhere(['like', 'order_sn', $this->order_sn])
            ->andFilterWhere(['like', 'consignee', $this->consignee])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pay_id', $this->pay_id])
            ->andFilterWhere(['like', 'pay_name', $this->pay_name]);
        $query->orderBy('order_id desc');
        return $dataProvider;
    }
}
