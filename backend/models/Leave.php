<?php

namespace backend\models;

use Yii;
use webvimark\modules\UserManagement\models\User;
use backend\models\LeaveCategories;
use backend\models\FinancialYear;
/**
 * This is the model class for table "{{%leave_master}}".
 *
 * @property integer $id
 * @property integer $emp_id
 * @property integer $leave_category
 * @property integer $financial_year
 * @property integer $used_leaves
 * @property integer $balanced_leaves
 * @property integer $total_leaves
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%leave_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_id', 'leave_category', 'financial_year', 'used_leaves', 'balanced_leaves', 'total_leaves'], 'required'],
            [['emp_id', 'leave_category', 'financial_year', 'used_leaves', 'balanced_leaves', 'total_leaves'], 'integer'],
            [['leave_category', 'emp_id' ,'financial_year'], 'unique', 'targetAttribute' => ['leave_category', 'emp_id' ,'financial_year'],'message'=> Yii::t('app','The combination of employee,leaveCategory,financialYear is already taken')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'emp_id' => Yii::t('app', 'Emp ID'),
            'leave_category' => Yii::t('app', 'Leave Category'),
            'financial_year' => Yii::t('app', 'Financial Year'),
            'used_leaves' => Yii::t('app', 'Used Leaves'),
            'balanced_leaves' => Yii::t('app', 'Balanced Leaves'),
            'total_leaves' => Yii::t('app', 'Total Leaves'),
        ];
    }
    public function getEmployee()
    {
            return $this->hasOne(User::className(), ['id' => 'emp_id']);
    }
    public function getLeaveCategory()
    {
            return $this->hasOne(LeaveCategories::className(), ['id' => 'leave_category']);
    }
    public function getFinancialYear()
    {
            return $this->hasOne(FinancialYear::className(), ['id' => 'financial_year']);
    }
}
