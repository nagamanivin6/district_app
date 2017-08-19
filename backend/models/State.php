<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%state_master}}".
 *
 * @property integer $state_id
 * @property string $state_name
 * @property integer $state_status
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%state_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_name', 'state_status'], 'required'],
            [['state_status'], 'integer'],
            [['state_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'state_id' => Yii::t('app', 'State ID'),
            'state_name' => Yii::t('app', 'State Name'),
            'state_status' => Yii::t('app', 'State Status'),
        ];
    }
}
