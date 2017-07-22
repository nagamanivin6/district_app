<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Issue;
use backend\models\Status;
$issuesList = ArrayHelper::map(Issue::find()->all(), 'issue_id', 'issue_desc');
$statusList = ArrayHelper::map(Status::find()->all(), 'status_id', 'status_name');
/* @var $this yii\web\View */
/* @var $model backend\models\Complaints */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complaints-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comp_desc')->textInput(['maxlength' => true,'disabled'=>true]) ?>

    <?= $form->field($model, 'issue_id')->dropDownList($issuesList,['prompt'=>'Select Issue','disabled'=>true]  ) ?>

    <?= $form->field($model, 'status')->dropDownList($statusList,['prompt'=>'Select Status']  ) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
