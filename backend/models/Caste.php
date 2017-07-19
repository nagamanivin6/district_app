<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%caste_master}}".
 *
 * @property integer $caste_id
 * @property string $caste_name
 * @property integer $caste_status
 */
class Caste extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%caste_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['caste_name', 'caste_status'], 'required'],
            [['caste_status'], 'integer'],
            [['caste_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'caste_id' => Yii::t('app', 'Caste ID'),
            'caste_name' => Yii::t('app', 'Caste Name'),
            'caste_status' => Yii::t('app', 'Caste Status'),
        ];
    }
}
