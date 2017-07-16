<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%village_master}}".
 *
 * @property integer $village_id
 * @property string $village_name
 * @property integer $mandal_id
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%village_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['village_name', 'mandal_id'], 'required'],
            [['mandal_id'], 'integer'],
            [['village_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'village_id' => Yii::t('app', 'Village ID'),
            'village_name' => Yii::t('app', 'Village Name'),
            'mandal_id' => Yii::t('app', 'Mandal ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return VillageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VillageQuery(get_called_class());
    }
}
