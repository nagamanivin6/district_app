<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\LeaveSearch;
use backend\components\GlobalFunctions;
use yii\jui\DatePicker;
$searchModel = new LeaveSearch();
$searchModel->emp_id = $leaveUserDetails->id;
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
/* @var $this yii\web\View */
/* @var $model backend\models\LeaveTrans */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-trans-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-6">
            <div class="col-xs-4">
                <label class="control-label" ><?php echo Yii::t('app','Employee Id'); ?></label>
            </div>
            <div class="col-xs-8">
                <span><?php echo $leaveUserDetails->emp_id ?></span>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="col-xs-4">
                <label class="control-label"><?php echo Yii::t('app','Registration Id'); ?></label>
            </div>
            <div class="col-xs-8">
                <span><?php echo $leaveUserDetails->id ?></span>
            </div>
        </div>
    </div>
    <div class="row" style="border-bottom: 1px solid black;">
        <div class="col-xs-6">
            <div class="col-xs-4">
                <label class="control-label" ><?php echo Yii::t('app','Employee Name'); ?></label>
            </div>
            <div class="col-xs-8">
                <span><?php echo $leaveUserDetails->username ?></span>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="col-xs-4">
                <label class="control-label" ><?php echo Yii::t('app','Father Name'); ?></label>
            </div>
            <div class="col-xs-8">
                <span><?php echo $leaveUserDetails->father_name ?></span>
            </div>
        </div>
    </div>
    <div style="border-bottom: 1px solid black;">
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'caption' =>'Leave Info',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
            'attribute' => 'leave_category',
            'value' => 'leaveCategory.leave_category_name',
            ],
            'used_leaves',
            'balanced_leaves',
            'total_leaves',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>
    <div style="font-size: 12pt;margin-top: 5px;">
        <b><?php echo Yii::t('app','Leave Applied For'); ?></b>
    </div>
    <!--<?= $form->field($model, 'emp_id')->textInput() ?>-->

    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'leave_category')->dropdownList(GlobalFunctions::GetLeaveCategories(),['class'=>'','prompt'=>'Select Category','disabled'=>($model->isNewRecord) ? false : true]) ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model, 'leave_days')->textInput(['class'=>'','disabled'=>($model->isNewRecord) ? false : true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model, 'leave_from')->widget(DatePicker::classname(), [
				'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => ['disabled'=>($model->isNewRecord) ? false : true]
			]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'leave_to')->widget(DatePicker::classname(), [
				'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => ['disabled'=>($model->isNewRecord) ? false : true]
			]) ?>
        </div>
        <?php if(!$model->isNewRecord) : ?>
         <div class="col-xs-4">
            <?= $form->field($model, 'leave_status')->dropdownList(GlobalFunctions::GetLeaveStatus(), [
                'prompt' => 'change Status',
                'class'=>'yes'
			]) ?>
        </div>
        <?php endif; ?>
    </div>
    <?= $form->field($model, 'leave_description')->textarea(['rows' => 4,'disabled'=>($model->isNewRecord) ? false : true]) ?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Apply') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>