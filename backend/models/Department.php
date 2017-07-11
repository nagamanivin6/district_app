<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%department_master}}".
 *
 * @property integer $dept_id
 * @property string $dept_name
 * @property integer $deptype_id
 * @property string $dept_place
 * @property string $dept_mand
 * @property integer $dept_dist
 * @property string $dept_ph1
 * @property string $dept_ph2
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_name', 'deptype_id', 'dept_place', 'dept_mand', 'dept_dist', 'dept_ph1', 'dept_ph2'], 'required'],
            [['deptype_id', 'dept_dist'], 'integer'],
            [['dept_name', 'dept_place', 'dept_mand', 'dept_ph1', 'dept_ph2'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dept_id' => Yii::t('app', 'Dept ID'),
            'dept_name' => Yii::t('app', 'Dept Name'),
            'deptype_id' => Yii::t('app', 'Deptype ID'),
            'dept_place' => Yii::t('app', 'Dept Place'),
            'dept_mand' => Yii::t('app', 'Dept Mand'),
            'dept_dist' => Yii::t('app', 'Dept Dist'),
            'dept_ph1' => Yii::t('app', 'Dept Ph1'),
            'dept_ph2' => Yii::t('app', 'Dept Ph2'),
        ];
    }

    /**
     * @inheritdoc
     * @return DepartmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartmentQuery(get_called_class());
    }
}
