<?php

namespace backend\components;

use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;
use backend\models\LeaveCategories;
use backend\models\FinancialYear;
use backend\models\LeaveStatus;
use backend\models\Department;
class GlobalFunctions {

    public static function GetAllEmployeeDetails(){
        $details = ArrayHelper::map(User::find()->all(),'id','username');
        return $details;
    }
    public static function GetLeaveCategories(){
        $details = ArrayHelper::map(LeaveCategories::find()->where(['leave_category_status'=>1])->all(),'id','leave_category_name');
        return $details;
    }
    public static function GetFinancialYear(){
        $details = ArrayHelper::map(FinancialYear::find()->where(['financial_year_status'=>1])->all(),'id','financial_year_name');
        return $details;
    }
    public static function GetEmployeeDetails($id){
        return User::find()->where(['id'=>$id])->one();
    }
    public static function GetLeaveStatus(){
        return ArrayHelper::map(LeaveStatus::find()->where(['leave_status_boolean'=>1])->all(),'id','leave_status_name');
    }
    public static function getAllDepartmentList(){
        return ArrayHelper::map(Department::find()->all(),'dept_id','dept_name');
    }
}
?>