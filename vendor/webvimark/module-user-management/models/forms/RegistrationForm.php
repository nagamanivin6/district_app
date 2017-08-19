<?php
namespace webvimark\modules\UserManagement\models\forms;

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\base\Model;
use Yii;
use yii\helpers\Html;

class RegistrationForm extends Model
{
	public $username;
	public $password;
	public $repeat_password;
	public $captcha;
	public $emp_id;
	public $dept_id;
	public $father_name;
	public $gender;
	public $emp_dob;
	public $caste;
	public $sub_caste;
	public $edu_qualification;
	public $aadhar_id;
	public $date_of_appointment;
	public $designation;
	public $emp_area;
	public $emp_village;
	public $emp_mandal;
	public $emp_district;
	public $emp_state;
	public $emp_pin;
	public $emp_phmob;
	public $emp_phres;
	public $emp_address;
	public $email;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$rules = [
			//['captcha', 'captcha', 'captchaAction'=>'/user-management/auth/captcha'],

			[['username', 'password', 'repeat_password','emp_id','dept_id','father_name','gender','caste','sub_caste','emp_dob','caste','sub_caste','edu_qualification','aadhar_id','date_of_appointment','designation','emp_phmob','emp_phres','emp_state','emp_district','emp_mandal','emp_village','emp_pin','emp_address','emp_area','email'], 'required'],
			[['username', 'password', 'repeat_password','emp_id'], 'trim'],

			['username', 'unique',
				'targetClass'     => 'webvimark\modules\UserManagement\models\User',
				'targetAttribute' => 'username',
			],
			['emp_id','unique',
				'targetClass'     => 'webvimark\modules\UserManagement\models\User',
				'targetAttribute' => 'emp_id'
			],
			['username', 'purgeXSS'],

			['password', 'string', 'max' => 255],
			['password', 'match', 'pattern' => Yii::$app->getModule('user-management')->passwordRegexp],

			['repeat_password', 'compare', 'compareAttribute'=>'password'],
		];

		if ( Yii::$app->getModule('user-management')->useEmailAsLogin )
		{
			$rules[] = ['username', 'email'];
		}
		else
		{
			$rules[] = ['username', 'string', 'max' => 50];

			$rules[] = ['username', 'match', 'pattern'=>Yii::$app->getModule('user-management')->registrationRegexp];
			$rules[] = ['username', 'match', 'not'=>true, 'pattern'=>Yii::$app->getModule('user-management')->registrationBlackRegexp];
		}

		return $rules;
	}

	/**
	 * Remove possible XSS stuff
	 *
	 * @param $attribute
	 */
	public function purgeXSS($attribute)
	{
		$this->$attribute = Html::encode($this->$attribute);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'username'        => Yii::$app->getModule('user-management')->useEmailAsLogin ? 'E-mail' : UserManagementModule::t('front', 'Employee Name'),
			'emp_id'		  => Yii::t('app', 'Employee Id'),
			'emp_phmob'		  => Yii::t('app', 'Mobile No'),
			'emp_phres'		  => Yii::t('app', 'Residence No'),
			'emp_address'	  => Yii::t('app', 'H. No'),
			'emp_area'		  => Yii::t('app', 'Area'),
			'emp_village'	  => Yii::t('app', 'Village'),
			'emp_mandal'	  => Yii::t('app', 'Mandal'),
			'emp_district'	  => Yii::t('app', 'District'),
			'emp_state'		  => Yii::t('app', 'State'),
			'emp_pin'		  => Yii::t('app', 'Pincode'),
			'father_name'	  => UserManagementModule::t('front', 'Father Name'),
			'password'        => UserManagementModule::t('front', 'Password'),
			'repeat_password' => UserManagementModule::t('front', 'Repeat password'),
			'captcha'         => UserManagementModule::t('front', 'Captcha'),
		];
	}

	/**
	 * @param bool $performValidation
	 *
	 * @return bool|User
	 */
	public function registerUser($performValidation = true)
	{
		if ( $performValidation AND !$this->validate() )
		{
			return false;
		}
		
		$user = new User();
		$user->password = $this->password;

		if ( Yii::$app->getModule('user-management')->useEmailAsLogin )
		{
			$user->email = $this->username;

			// If email confirmation required then we save user with "inactive" status
			// and without username (username will be filled with email value after confirmation)
			if ( Yii::$app->getModule('user-management')->emailConfirmationRequired )
			{
				$user->status = User::STATUS_INACTIVE;
				$user->generateConfirmationToken();
				$user->save(false);

				$this->saveProfile($user);

				if ( $this->sendConfirmationEmail($user) )
				{
					return $user;
				}
				else
				{
					$this->addError('username', UserManagementModule::t('front', 'Could not send confirmation email'));
				}
			}
			else
			{
				$user->username = $this->username;
			}
		}
		else
		{
			$user->username = $this->username;
		}
		$user->emp_id = $this->emp_id;
		$user->dept_id = $this->dept_id;
		$user->father_name = $this->father_name;
		$user->gender = $this->gender;
		$user->emp_dob = $this->emp_dob;
		$user->caste = $this->caste;
		$user->sub_caste = $this->sub_caste;
		$user->edu_qualification = $this->edu_qualification;
		$user->aadhar_id = $this->aadhar_id;
		$user->date_of_appointment = $this->date_of_appointment;
		$user->designation = $this->designation;
		$user->emp_area = $this->emp_area;
		$user->emp_village = $this->emp_village;
		$user->emp_mandal = $this->emp_mandal;
		$user->emp_pin = $this->emp_pin;
		$user->emp_district = $this->emp_district;
		$user->emp_state = $this->emp_state;
		$user->emp_phmob = $this->emp_phmob;
		$user->emp_phres = $this->emp_phres;
		$user->emp_address = $this->emp_address;
		$user->email = $this->email;
		if ( $user->save() )
		{
			$this->saveProfile($user);

			return $user;
		}
		else
		{
			$this->addError('username', UserManagementModule::t('front', 'Login has been taken'));
		}
	}

	/**
	 * Implement your own logic if you have user profile and save some there after registration
	 *
	 * @param User $user
	 */
	protected function saveProfile($user)
	{
	}


	/**
	 * @param User $user
	 *
	 * @return bool
	 */
	protected function sendConfirmationEmail($user)
	{
		return Yii::$app->mailer->compose(Yii::$app->getModule('user-management')->mailerOptions['registrationFormViewFile'], ['user' => $user])
			->setFrom(Yii::$app->getModule('user-management')->mailerOptions['from'])
			->setTo($user->email)
			->setSubject(UserManagementModule::t('front', 'E-mail confirmation for') . ' ' . Yii::$app->name)
			->send();
	}

	/**
	 * Check received confirmation token and if user found - activate it, set username, roles and log him in
	 *
	 * @param string $token
	 *
	 * @return bool|User
	 */
	public function checkConfirmationToken($token)
	{
		$user = User::findInactiveByConfirmationToken($token);

		if ( $user )
		{
			$user->username = $user->email;
			$user->status = User::STATUS_ACTIVE;
			$user->email_confirmed = 1;
			$user->removeConfirmationToken();
			$user->save(false);

			$roles = (array)Yii::$app->getModule('user-management')->rolesAfterRegistration;

			foreach ($roles as $role)
			{
				User::assignRole($user->id, $role);
			}

			Yii::$app->user->login($user);

			return $user;
		}

		return false;
	}
}
