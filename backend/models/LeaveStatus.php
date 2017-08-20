<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%leave_status_master}}".
 *
 * @property integer $id
 * @property string $leave_status_name
 * @property integer $leave_status_boolean
 */
class LeaveStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%leave_status_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leave_status_name', 'leave_status_boolean'], 'required'],
            [['leave_status_boolean'], 'integer'],
            [['leave_status_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'leave_status_name' => Yii::t('app', 'Leave Status Name'),
            'leave_status_boolean' => Yii::t('app', 'Leave Status Boolean'),
        ];
    }
}
