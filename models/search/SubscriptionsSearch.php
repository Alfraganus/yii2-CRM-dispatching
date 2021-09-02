<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subscriptions;

/**
 * SubscriptionsSearch represents the model behind the search form of `app\models\Subscriptions`.
 */
class SubscriptionsSearch extends Subscriptions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tariff_id', 'company_id'], 'integer'],
            [['subscription_start_date', 'subscription_end_date'], 'safe'],
            [['overall_price'], 'number'],
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
        $query = Subscriptions::find();

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
            'tariff_id' => $this->tariff_id,
            'company_id' => $this->company_id,
            'subscription_start_date' => $this->subscription_start_date,
            'subscription_end_date' => $this->subscription_end_date,
            'overall_price' => $this->overall_price,
        ]);

        return $dataProvider;
    }
}
