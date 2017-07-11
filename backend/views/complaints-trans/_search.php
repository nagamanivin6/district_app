<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintsTransSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complaints-trans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'comp_transid') ?>

    <?= $form->field($model, 'comp_id') ?>

    <?= $form->field($model, 'comp_status') ?>

    <?= $form->field($model, 'comp_empregid') ?>

    <?= $form->field($model, 'comp_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
