<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\GlobalFunctions;

$employees = GlobalFunctions::GetAllEmployeeDetails();
$leaveCategories = GlobalFunctions::GetLeaveCategories();
$financialYears = GlobalFunctions::GetFinancialYear();
/* @var $this yii\web\View */
/* @var $model backend\models\Leave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emp_id')->dropDownList($employees,['prompt'=>Yii::t('app','Select employees')]  ) ?>

    <?= $form->field($model, 'leave_category')->dropDownList($leaveCategories,['prompt'=>Yii::t('app','Select Leave Category')]  ) ?>

    <?= $form->field($model, 'financial_year')->dropDownList($financialYears,['prompt'=>Yii::t('app','Select Financial Year')]  ) ?>

    <?= $form->field($model, 'total_leaves')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
