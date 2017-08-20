<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LeaveTransSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-trans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'emp_id') ?>

    <?= $form->field($model, 'leave_category') ?>

    <?= $form->field($model, 'leave_description') ?>

    <?= $form->field($model, 'leave_days') ?>

    <?php // echo $form->field($model, 'leave_from') ?>

    <?php // echo $form->field($model, 'leave_to') ?>

    <?php // echo $form->field($model, 'leave_status') ?>

    <?php // echo $form->field($model, 'leave_updated_by') ?>

    <?php // echo $form->field($model, 'leave_updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
