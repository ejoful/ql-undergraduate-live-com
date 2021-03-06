<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Message;
use backend\models\User;

/**
 * MessageSearch represents the model behind the search form about `backend\models\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg_id', 'publisher', 'status', 'created_time', 'publish_time'], 'integer'],
            [['content', 'classids', 'cityid', 'title'], 'safe'],
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
        $query = Message::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['msg_id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'msg_id' => $this->msg_id,
            'publisher' => $this->publisher,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'publish_time' => $this->publish_time,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'title', $this->classids])
            ->andFilterWhere(['like', 'classids', $this->classids])
            ->andFilterWhere(['like', 'cityid', $this->cityid]);

        $roles_array = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        if(!array_key_exists('admin',$roles_array)) {
            $query->andFilterWhere(['publisher' => Yii::$app->user->id]);
        }

        return $dataProvider;
    }
}
