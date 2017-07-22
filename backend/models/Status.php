<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%status_master}}".
 *
 * @property integer $status_id
 * @property string $status_name
 * @property string $color
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%status_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_name', 'color'], 'required'],
            [['status_name', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => Yii::t('app', 'Status ID'),
            'status_name' => Yii::t('app', 'Status Name'),
            'color' => Yii::t('app', 'Color'),
        ];
    }
}
