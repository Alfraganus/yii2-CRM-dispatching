<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Loads;

/**
 * LoadsSearch represents the model behind the search form of `app\models\Loads`.
 */
class LoadsSearch extends Loads
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'broker_id', 'load_id', 'is_assigned'], 'integer'],
            [['po_number', 'commodity', 'upload_rate_confirm'], 'safe'],
            [['loaded_mile', 'total_rate', 'upload_bol'], 'number'],
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
        $query = Loads::find();

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
            'company_id' => $this->company_id,
            'broker_id' => $this->broker_id,
            'load_id' => $this->load_id,
            'loaded_mile' => $this->loaded_mile,
            'total_rate' => $this->total_rate,
            'upload_bol' => $this->upload_bol,
            'is_assigned' => $this->is_assigned,
        ]);

        $query->andFilterWhere(['like', 'po_number', $this->po_number])
            ->andFilterWhere(['like', 'commodity', $this->commodity])
            ->andFilterWhere(['like', 'upload_rate_confirm', $this->upload_rate_confirm]);

        return $dataProvider;
    }
}
