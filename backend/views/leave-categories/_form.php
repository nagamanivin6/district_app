<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LeaveCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'leave_category_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'leave_category_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
