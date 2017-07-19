<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%religion_master}}".
 *
 * @property integer $religion_id
 * @property string $religion_name
 * @property integer $religion_status
 */
class Religion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%religion_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['religion_name', 'religion_status'], 'required'],
            [['religion_status'], 'integer'],
            [['religion_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'religion_id' => Yii::t('app', 'Religion ID'),
            'religion_name' => Yii::t('app', 'Religion Name'),
            'religion_status' => Yii::t('app', 'Religion Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return ReligionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReligionQuery(get_called_class());
    }
}
