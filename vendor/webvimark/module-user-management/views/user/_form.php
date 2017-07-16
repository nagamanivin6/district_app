<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\ArrayHelper;
use backend\models\Department;
/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */


 $departments = ArrayHelper::map(Department::find()->all(), 'dept_id', 'dept_name');
?>

<div class="user-form">

	<?php $form = ActiveForm::begin([
		'id'=>'user',
		'layout'=>'horizontal',
		'validateOnBlur' => false,
	]); ?>

	<?= $form->field($model->loadDefaultValues(), 'status')
		->dropDownList(User::getStatusList()) ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
	<?= $form->field($model, 'emp_id')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
	<?php if ( User::hasPermission('editUserEmail') ): ?>

		<?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
		<!--<?= $form->field($model, 'email_confirmed')->checkbox() ?>-->

	<?php endif; ?>

	 <?= $form->field($model, 'dept_id')->dropDownList($departments,['prompt'=>'Select department']  ) ?>
	 <?= $form->field($model, 'emp_phmob')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
	 <?= $form->field($model, 'emp_phres')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
	 <?= $form->field($model, 'emp_address')->textArea() ?>
	<?php if ( $model->isNewRecord ): ?>

		<?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

		<?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
	<?php endif; ?>

<?= $form->field($model, 'superadmin')->checkbox() ?>
	<!--<?php if ( User::hasPermission('bindUserToIp') ): ?>

		<?= $form->field($model, 'bind_to_ip')
			->textInput(['maxlength' => 255])
			->hint(UserManagementModule::t('back','For example: 123.34.56.78, 168.111.192.12')) ?>

	<?php endif; ?>-->




	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<?php if ( $model->isNewRecord ): ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-plus-sign"></span> ' . UserManagementModule::t('back', 'Create'),
					['class' => 'btn btn-success']
				) ?>
			<?php else: ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('back', 'Save'),
					['class' => 'btn btn-primary']
				) ?>
			<?php endif; ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>