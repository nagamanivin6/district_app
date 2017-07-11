<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsTrans */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complaints-trans-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comp_id')->textInput() ?>

    <?= $form->field($model, 'comp_status')->textInput() ?>

    <?= $form->field($model, 'comp_empregid')->textInput() ?>

    <?= $form->field($model, 'comp_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
