<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Issue;

/**
 * IssueSearch represents the model behind the search form about `backend\models\Issue`.
 */
class IssueSearch extends Issue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issue_id', 'issue_priority', 'dept_id', 'issue_status'], 'integer'],
            [['issue_desc', 'issue_desctel'], 'safe'],
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
        $query = Issue::find();

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
            'issue_id' => $this->issue_id,
            'issue_priority' => $this->issue_priority,
            'dept_id' => $this->dept_id,
            'issue_status' => $this->issue_status,
        ]);

        $query->andFilterWhere(['like', 'issue_desc', $this->issue_desc])
            ->andFilterWhere(['like', 'issue_desctel', $this->issue_desctel]);

        return $dataProvider;
    }
}
