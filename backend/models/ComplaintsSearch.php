<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Complaints;

/**
 * ComplaintsSearch represents the model behind the search form about `backend\models\Complaints`.
 */
class ComplaintsSearch extends Complaints
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comp_id', 'issue_id', 'user_regid'], 'integer'],
            [['comp_desc', 'created_date'], 'safe'],
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
        $query = Complaints::find();

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
            'comp_id' => $this->comp_id,
            'issue_id' => $this->issue_id,
            'user_regid' => $this->user_regid,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'comp_desc', $this->comp_desc]);

        return $dataProvider;
    }
}
