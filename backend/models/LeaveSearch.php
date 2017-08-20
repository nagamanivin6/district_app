<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Leave;

/**
 * LeaveSearch represents the model behind the search form about `backend\models\Leave`.
 */
class LeaveSearch extends Leave
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'emp_id', 'leave_category', 'financial_year', 'used_leaves', 'balanced_leaves', 'total_leaves'], 'integer'],
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
        $query = Leave::find();

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
            'emp_id' => $this->emp_id,
            'leave_category' => $this->leave_category,
            'financial_year' => $this->financial_year,
            'used_leaves' => $this->used_leaves,
            'balanced_leaves' => $this->balanced_leaves,
            'total_leaves' => $this->total_leaves,
        ]);

        return $dataProvider;
    }
}
