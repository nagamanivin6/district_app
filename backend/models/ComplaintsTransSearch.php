<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ComplaintsTrans;

/**
 * ComplaintsTransSearch represents the model behind the search form about `backend\models\ComplaintsTrans`.
 */
class ComplaintsTransSearch extends ComplaintsTrans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comp_transid', 'comp_id', 'comp_status', 'comp_empregid'], 'integer'],
            [['comp_date'], 'safe'],
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
        $query = ComplaintsTrans::find();

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
            'comp_transid' => $this->comp_transid,
            'comp_id' => $this->comp_id,
            'comp_status' => $this->comp_status,
            'comp_empregid' => $this->comp_empregid,
            'comp_date' => $this->comp_date,
        ]);

        return $dataProvider;
    }
}
