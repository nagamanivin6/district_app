<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\District;
use yii\helpers\ArrayHelper;

$districts = ArrayHelper::map(District::find()->all(),'dist_id','dist_name');
/* @var $this yii\web\View */
/* @var $model backend\models\Mandal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mandal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mandal_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dist_id')->dropDownList($districts,['prompt'=>'Select district']  ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
