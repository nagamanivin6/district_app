<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%customer_master}}".
 *
 * @property integer $user_id
 * @property integer $user_uid
 * @property string $user_name
 * @property string $user_password
 * @property string $user_mother
 * @property string $user_father
 * @property integer $user_gender
 * @property string $user_dob
 * @property string $user_email
 * @property string $user_phone
 * @property string $user_hno
 * @property string $user_area
 * @property string $user_village
 * @property string $user_mandal
 * @property integer $user_dist
 * @property integer $user_pin
 * @property string $user_state
 * @property integer $user_status
 */
class Customer extends ActiveRecord implements IdentityInterface
{
     const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_master}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_uid', 'user_name', 'user_father', 'user_gender', 'user_dob', 'user_email', 'user_phone', 'user_hno', 'user_area', 'user_village', 'user_mandal', 'user_dist', 'user_pin', 'user_state', 'user_status'], 'required'],
            [['user_uid', 'user_gender', 'user_dist', 'user_pin', 'user_status','user_mandal','user_village'], 'integer'],
            [['user_dob','created_at','updated_at'], 'safe'],
            [['user_name'],'unique'],
            [['user_uid'],'integer'],
            [['user_password'],'required','on' => ['changepassword','emailVerified','login']],
            [['user_name', 'user_password', 'user_father','user_mother', 'user_email', 'user_phone', 'user_hno', 'user_area', 'user_state'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'user_uid' => Yii::t('app', 'Aadhaar  card Id'),
            'user_name' => Yii::t('app', 'User Name'),
            'user_password' => Yii::t('app', 'User Password'),
            'user_mother' => Yii::t('app', 'Mother Name'),
            'user_father' => Yii::t('app', 'Father Name'),
            'user_gender' => Yii::t('app', 'User Gender'),
            'user_dob' => Yii::t('app', 'User Dob'),
            'user_email' => Yii::t('app', 'User Email'),
            'user_phone' => Yii::t('app', 'User Phone'),
            'user_hno' => Yii::t('app', 'User Hno'),
            'user_area' => Yii::t('app', 'User Area'),
            'user_village' => Yii::t('app', 'User Place'),
            'user_mandal' => Yii::t('app', 'User Mandal'),
            'user_dist' => Yii::t('app', 'User Dist'),
            'user_pin' => Yii::t('app', 'User Pin'),
            'user_state' => Yii::t('app', 'User State'),
            'user_status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }

    public function setPassword($password)
    {
        $this->user_password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
     /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->user_password);
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['user_name' => $username, 'user_status' => self::STATUS_ACTIVE]);
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
}
