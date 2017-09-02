<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LeaveTrans;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;

/**
 * LeaveTransSearch represents the model behind the search form about `backend\models\LeaveTrans`.
 */
class LeaveTransSearch extends LeaveTrans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'emp_id', 'leave_category', 'leave_days', 'leave_status', 'leave_updated_by','leave_financial_year'], 'integer'],
            [['leave_description', 'leave_from', 'leave_to', 'leave_updated_time','leave_financial_year'], 'safe'],
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
        $query = LeaveTrans::find();
        $query->joinWith(['employee','leaveCategory']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if(!Yii::$app->user->isSuperadmin) {
            $query->andFilterWhere([
                LeaveTrans::tableName().'.emp_id' => Yii::$app->user->id,
            ]);
        }
        else {
            $users = ArrayHelper::map(User::find()->where(['dept_id'=>Yii::$app->user->identity->dept_id])->all(), 'id', 'id');
            $query->andFilterWhere([
                LeaveTrans::tableName().'.emp_id' => $users,
            ]);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'emp_id' => $this->emp_id,
            'leave_category' => $this->leave_category,
            'leave_days' => $this->leave_days,
            'leave_from' => $this->leave_from,
            'leave_to' => $this->leave_to,
            'leave_status' => $this->leave_status,
            'leave_updated_by' => $this->leave_updated_by,
            'leave_updated_time' => $this->leave_updated_time,
            'leave_financial_year'=>$this->leave_financial_year
        ]);
        //$query->andFilterWhere(['like', User::tableName().'.id', $this->emp_id]);
        $query->andFilterWhere(['like', 'leave_description', $this->leave_description]);

        return $dataProvider;
    }
}
