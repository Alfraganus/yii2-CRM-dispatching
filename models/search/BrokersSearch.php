<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Brokers;

/**
 * BrokersSearch represents the model behind the search form of `app\models\Brokers`.
 */
class BrokersSearch extends Brokers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['broker_name', 'broker_state', 'broker_city', 'broker_zip', 'broker_phone', 'broker_fax', 'broker_email', 'broker_contact_person'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Brokers::find();

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
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'broker_name', $this->broker_name])
            ->andFilterWhere(['like', 'broker_state', $this->broker_state])
            ->andFilterWhere(['like', 'broker_city', $this->broker_city])
            ->andFilterWhere(['like', 'broker_zip', $this->broker_zip])
            ->andFilterWhere(['like', 'broker_phone', $this->broker_phone])
            ->andFilterWhere(['like', 'broker_fax', $this->broker_fax])
            ->andFilterWhere(['like', 'broker_email', $this->broker_email])
            ->andFilterWhere(['like', 'broker_contact_person', $this->broker_contact_person]);

        return $dataProvider;
    }
}
