<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\models\Department;
use backend\models\Caste;
use backend\models\CasteGroup;
use backend\models\Designation;
use backend\models\EduQualification;
use backend\models\State;
use yii\jui\DatePicker;
/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\RegistrationForm $model
 */

$this->title = UserManagementModule::t('front', 'Employee Registration');
$this->params['breadcrumbs'][] = $this->title;
$departments = ArrayHelper::map(Department::find()->all(), 'dept_id', 'dept_name');
$castes = ArrayHelper::map(Caste::find()->all(), 'caste_id', 'caste_name');
$subCastes = ArrayHelper::map(CasteGroup::find()->all(), 'caste_group_id', 'caste_group_name','caste_id');
$educationDetails = ArrayHelper::map(EduQualification::find()->where(['education_status'=>1])->all(), 'education_id', 'education_name');
$designations = ArrayHelper::map(Designation::find()->where(['designation_status'=>1])->all(), 'designation_id', 'designation_name');
$states = ArrayHelper::map(State::find()->all(), 'state_id', 'state_name');
$selectedSubCasteGroups = [];
?>

<div class="user-registration">

	<h2 class="text-center"><?= $this->title ?></h2>
	<div class="row" style="width:100%">
		<?php $form = ActiveForm::begin([
			'id'=>'user',
			'layout'=>'horizontal',
			'validateOnBlur'=>false,
		]); ?>
		<div class="col-lg-6">
		
			<?= $form->field($model, 'emp_id')->textInput(['maxlength' => 50, 'autocomplete'=>'off', 'autofocus'=>true]) ?>

			<?= $form->field($model, 'username')->textInput(['maxlength' => 50, 'autocomplete'=>'off']) ?>

			<?= $form->field($model, 'gender')->dropDownList([1=>Yii::t('app','Male'),0=>Yii::t('app','Female')],['prompt'=>Yii::t('app','Select Gender')]) ?>

			<?= $form->field($model, 'caste')->dropDownList($castes,['prompt'=>Yii::t('app','Select caste'),'onchange'=>' $.post( "'.Yii::$app->urlManager->createUrl('user-management/auth/get-sub-caste').'",{id: $(this).val()}, function( data ) {
                  $( "select#subcaste" ).html( data );
                });']) ?>

			<?= $form->field($model, 'edu_qualification')->dropDownList($educationDetails,['prompt'=>Yii::t('app','Select Education')]) ?>

			<?= $form->field($model, 'date_of_appointment')->widget(DatePicker::classname(), [
				//'dateFormat' => 'yyyy-MM-dd',
			]) ?>
			<?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

			<?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

			<?= $form->field($model, 'emp_state')->dropDownList($states,['prompt'=>Yii::t('app','Select state'),'onchange'=>' $.post( "'.Yii::$app->urlManager->createUrl('user-management/auth/districts').'",{id: $(this).val()}, function( data ) {
                  $( "select#district" ).html( data );
                });']) ?>
			<?= $form->field($model, 'emp_mandal')->dropDownList([],['prompt'=>Yii::t('app','Select Mandal'),'id'=>'mandal','onchange'=>' $.post( "'.Yii::$app->urlManager->createUrl('user-management/auth/villages').'",{id: $(this).val()}, function( data ) {
				$( "select#village" ).html( data );
			});']) ?>

			<?= $form->field($model, 'emp_address')->textInput(['maxlength' => 50, 'autocomplete'=>'off']) ?>

			<?= $form->field($model, 'emp_pin')->textInput(['maxlength' => 50, 'autocomplete'=>'off']) ?>
			<!--<?= $form->field($model, 'captcha')->widget(Captcha::className(), [
				'template' => '<div class="row"><div class="col-sm-5">{image}</div><div class="col-sm-5">{input}</div></div>',
				'captchaAction'=>['/user-management/auth/captcha']
			]) ?>-->
		</div>
		<div class="col-lg-6">
			<?= $form->field($model, 'dept_id')->dropDownList($departments,['prompt'=>Yii::t('app','Select department')]) ?>

			<?= $form->field($model, 'father_name')->textInput(['maxlength' => 50, 'autocomplete'=>'off']) ?>

			<?= $form->field($model, 'emp_dob')->widget(DatePicker::classname(), [
				//'dateFormat' => 'yyyy-MM-dd',
			]) ?>
			<?= $form->field($model, 'sub_caste')->dropDownList([],['prompt'=>Yii::t('app','Select Sub Caste'), 'id' => 'subcaste']) ?>

			<?= $form->field($model, 'aadhar_id')->textInput(['maxlength' => 50, 'autocomplete'=>'off']) ?>

			<?= $form->field($model, 'designation')->dropDownList($designations,['prompt'=>Yii::t('app','Select Designation')]) ?>

			<?= $form->field($model, 'emp_phmob')->textInput(['maxlength' => 50, 'autocomplete'=>'off']) ?>

			<?= $form->field($model, 'emp_phres')->textInput(['maxlength' => 50, 'autocomplete'=>'off']) ?>

			<?= $form->field($model, 'emp_district')->dropDownList([],['prompt'=>Yii::t('app','Select district'),'id'=>'district','onchange'=>' $.post( "'.Yii::$app->urlManager->createUrl('user-management/auth/mandals').'",{id: $(this).val()}, function( data ) {
				$( "select#mandal" ).html( data );
			});']) ?>
			<?= $form->field($model, 'emp_village')->dropDownList([],['prompt'=>Yii::t('app','Select village'),'id'=>'village']) ?>

			<?= $form->field($model, 'emp_area')->textInput(['maxlength' => 50, 'autocomplete'=>'off']) ?>
			
			<?= $form->field($model, 'email')->input('email') ?>
		</div>
		<div class="form-group">
				<div class="col-sm-offset-6 col-sm-6">
					<?= Html::submitButton(
						'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('front', 'Register'),
						['class' => 'btn btn-primary']
					) ?>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>
