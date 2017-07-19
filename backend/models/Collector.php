<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%collector_master}}".
 *
 * @property integer $id
 * @property integer $dist_id
 * @property integer $state_id
 */
class Collector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%collector_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dist_id', 'state_id'], 'required'],
            [['dist_id', 'state_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dist_id' => Yii::t('app', 'Dist ID'),
            'state_id' => Yii::t('app', 'State ID'),
        ];
    }
}
