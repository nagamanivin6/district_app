<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%department_type}}".
 *
 * @property integer $depttype_id
 * @property integer $deptype_name
 */
class DepartmentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deptype_name'], 'required'],
            [['deptype_name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'depttype_id' => Yii::t('app', 'Depttype ID'),
            'deptype_name' => Yii::t('app', 'Deptype Name'),
        ];
    }
}
