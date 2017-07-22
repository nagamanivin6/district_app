<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Complaints;
use frontend\models\Customer;
use backend\models\Issue;
use yii\helpers\ArrayHelper;
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
            [['comp_id'], 'integer'],
            [['comp_desc', 'created_date','user_regid','status','issue_id'], 'safe'],
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
        $query->joinWith(['customer','issueInfo']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['user_regid'] = [
            'asc' => [Customer::tableName().'.user_name' => SORT_ASC],
            'desc' => [Customer::tableName().'.user_name' => SORT_DESC],
        ];
        $this->load($params);
       
        if(!Yii::$app->user->isSuperadmin) {
            $issues = ArrayHelper::map(Issue::find()->where(['dept_id'=>Yii::$app->user->identity->dept_id])->all(), 'issue_id', 'issue_id');
            //print_r($issues); exit;
            $query->andFilterWhere([
                Issue::tableName().'.issue_id' => $issues,
            ]);
            //echo "<pre>";print_r(Yii::$app->user->identity->dept_id); exit;
        }
        else {
            $query->andFilterWhere([
                Issue::tableName().'.issue_id' => $this->issue_id,
            ]);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'comp_id' => $this->comp_id,
            'created_date' => $this->created_date,
            'status'=>$this->status
        ]);
        $query->andFilterWhere(['like', Issue::tableName().'.issue_desc', $this->issue_id]);
        $query->andFilterWhere(['like', Customer::tableName().'.user_name', $this->user_regid]);
        $query->andFilterWhere(['like', 'comp_desc', $this->comp_desc]);
        
        return $dataProvider;
    }
}
