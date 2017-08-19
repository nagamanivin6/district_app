<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%edu_qualification_master}}".
 *
 * @property integer $education_id
 * @property string $education_name
 * @property integer $education_status
 */
class EduQualification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%edu_qualification_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['education_name', 'education_status'], 'required'],
            [['education_status'], 'integer'],
            [['education_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'education_id' => Yii::t('app', 'Education ID'),
            'education_name' => Yii::t('app', 'Education Name'),
            'education_status' => Yii::t('app', 'Education Status'),
        ];
    }
}
