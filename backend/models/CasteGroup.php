<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%caste_group_master}}".
 *
 * @property integer $caste_group_id
 * @property string $caste_group_name
 * @property integer $caste_id
 * @property integer $caste_group_status
 */
class CasteGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%caste_group_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['caste_group_name', 'caste_id', 'caste_group_status'], 'required'],
            [['caste_id', 'caste_group_status'], 'integer'],
            [['caste_group_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'caste_group_id' => Yii::t('app', 'Caste Group ID'),
            'caste_group_name' => Yii::t('app', 'Caste Group Name'),
            'caste_id' => Yii::t('app', 'Caste ID'),
            'caste_group_status' => Yii::t('app', 'Caste Group Status'),
        ];
    }
}
