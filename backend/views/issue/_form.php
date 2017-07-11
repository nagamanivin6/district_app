<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Department;
$departments= ArrayHelper::map(Department::find()->all(), 'dept_id', 'dept_name');

/* @var $this yii\web\View */
/* @var $model backend\models\Issue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="issue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'issue_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issue_desctel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issue_priority')->textInput() ?>

    <?= $form->field($model, 'dept_id')->dropDownList($departments,['prompt'=>'Select department']  )?>

    <?= $form->field($model, 'issue_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
