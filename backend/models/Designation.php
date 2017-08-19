<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%designation_master}}".
 *
 * @property integer $designation_id
 * @property string $designation_name
 * @property integer $designation_status
 */
class Designation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%designation_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['designation_name', 'designation_status'], 'required'],
            [['designation_status'], 'integer'],
            [['designation_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'designation_id' => Yii::t('app', 'Designation ID'),
            'designation_name' => Yii::t('app', 'Designation Name'),
            'designation_status' => Yii::t('app', 'Designation Status'),
        ];
    }
}
