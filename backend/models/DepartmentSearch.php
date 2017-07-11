<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Department;

/**
 * DepartmentSearch represents the model behind the search form about `backend\models\Department`.
 */
class DepartmentSearch extends Department
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_id', 'deptype_id', 'dept_dist'], 'integer'],
            [['dept_name', 'dept_place', 'dept_mand', 'dept_ph1', 'dept_ph2'], 'safe'],
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
        $query = Department::find();

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
            'dept_id' => $this->dept_id,
            'deptype_id' => $this->deptype_id,
            'dept_dist' => $this->dept_dist,
        ]);

        $query->andFilterWhere(['like', 'dept_name', $this->dept_name])
            ->andFilterWhere(['like', 'dept_place', $this->dept_place])
            ->andFilterWhere(['like', 'dept_mand', $this->dept_mand])
            ->andFilterWhere(['like', 'dept_ph1', $this->dept_ph1])
            ->andFilterWhere(['like', 'dept_ph2', $this->dept_ph2]);

        return $dataProvider;
    }
}
