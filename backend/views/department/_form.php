<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\DepartmentType;
use backend\models\District;

$department_types = ArrayHelper::map(DepartmentType::find()->all(), 'depttype_id', 'deptype_name');
$districts = ArrayHelper::map(District::find()->all(), 'dist_id', 'dist_name');

/* @var $this yii\web\View */
/* @var $model backend\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dept_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deptype_id')->dropDownList($department_types,['prompt'=>'Select department Type']  ) ?>

    <?= $form->field($model, 'dept_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dept_mand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dept_dist')->dropDownList($districts,['prompt'=>'Select District']  ) ?>

    <?= $form->field($model, 'dept_ph1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dept_ph2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
