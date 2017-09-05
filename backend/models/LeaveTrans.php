<?php

namespace backend\models;

use Yii;
use webvimark\modules\UserManagement\models\User;
use backend\models\LeaveCategories;
use backend\models\LeaveStatus;
use backend\models\Leave;
/**
 * This is the model class for table "{{%leave_trans}}".
 *
 * @property integer $id
 * @property integer $emp_id
 * @property integer $leave_category
 * @property string $leave_description
 * @property integer $leave_days
 * @property string $leave_from
 * @property string $leave_to
 * @property integer $leave_status
 * @property integer $leave_updated_by
 * @property string $leave_updated_time
 */
class LeaveTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%leave_trans}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_id', 'leave_category', 'leave_description', 'leave_days', 'leave_from', 'leave_to', 'leave_status', 'leave_updated_by', 'leave_updated_time','leave_financial_year'], 'required'],
            [['emp_id', 'leave_category', 'leave_days', 'leave_status', 'leave_updated_by','leave_financial_year'], 'integer'],
            [['leave_description'], 'string'],
            [['leave_from','leave_to'],'lastDateValidation'],
            ['leave_days','leaveValidation'],
            [['leave_from', 'leave_to', 'leave_updated_time'], 'safe'],
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
            'leave_financial_year'=> Yii::t('app','Financial Year'),
            'leave_description' => Yii::t('app', 'Leave Description'),
            'leave_days' => Yii::t('app', 'No Of Days'),
            'leave_from' => Yii::t('app', 'Leave From'),
            'leave_to' => Yii::t('app', 'Leave To'),
            'leave_status' => Yii::t('app', 'Leave Status'),
            'leave_updated_by' => Yii::t('app', 'Leave Updated By'),
            'leave_updated_time' => Yii::t('app', 'Leave Updated Time'),
        ];
    }
    public function lastDateValidation($attribute){
        if(strtotime($this->leave_to) <= strtotime($this->leave_from)){
            //$this->addError('leave_from',Yii::t('app', 'Please give correct Start and End dates'));
            $this->addError('leave_to',Yii::t('app', 'Please give correct Start and End dates'));
        }
       // $alreadyAppliedLeaves = LeaveTrans::find()->andWhere('leave_from ')->one();

    }
    public function leaveValidation($attribute){
        
        $eligibleLeaves = Leave::find()->where(['emp_id'=>$this->emp_id,"leave_category"=>$this->leave_category,"financial_year"=>$this->leave_financial_year])->one();
        if($this->id) {
                $alreadyAppliedLeaves = LeaveTrans::find()->where('emp_id = :emp_id and leave_category= :leave_category and leave_financial_year= :leave_financial_year and id != :id',['emp_id'=>$this->emp_id,'leave_category'=>$this->leave_category,'leave_financial_year'=>$this->leave_financial_year,'id'=>$this->id])->sum('leave_days');
        }
        else 
        $alreadyAppliedLeaves = LeaveTrans::find()->where(['emp_id'=>$this->emp_id,'leave_category'=>$this->leave_category,'leave_financial_year'=>$this->leave_financial_year])->sum('leave_days');
        if($eligibleLeaves) {
            if(($alreadyAppliedLeaves + $this->leave_days) > $eligibleLeaves->total_leaves)
            $this->addError('leave_days',Yii::t('app', 'Leaves Completed or already applied'));
        }
        else {
            $this->addError('leave_days',Yii::t('app', 'No eligible leaves in this category'));
        }
    }
    public function getEmployee()
    {
            return $this->hasOne(User::className(), ['id' => 'emp_id']);
    }
    public function getLeaveCategory()
    {
            return $this->hasOne(LeaveCategories::className(), ['id' => 'leave_category']);
    }
     public function getLeaveStatus()
    {
            return $this->hasOne(LeaveStatus::className(), ['id' => 'leave_status']);
    }
    public function getHeadOfDept(){
        return $this->hasOne(User::className(), ['id' => 'leave_updated_by']);
    }
}
