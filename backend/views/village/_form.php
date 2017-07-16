<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Mandal;
use yii\helpers\ArrayHelper;
$mandals = ArrayHelper::map(Mandal::find()->all(),'mandal_id','mandal_name');
/* @var $this yii\web\View */
/* @var $model backend\models\Village */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="village-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'village_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mandal_id')->dropDownList($mandals,['prompt'=>'Select Mandal']  ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
