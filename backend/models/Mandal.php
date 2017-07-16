<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%mandal_master}}".
 *
 * @property integer $mandal_id
 * @property string $mandal_name
 * @property integer $dist_id
 */
class Mandal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mandal_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mandal_name', 'dist_id'], 'required'],
            [['dist_id'], 'integer'],
            [['mandal_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mandal_id' => Yii::t('app', 'Mandal ID'),
            'mandal_name' => Yii::t('app', 'Mandal Name'),
            'dist_id' => Yii::t('app', 'Dist ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return MandalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MandalQuery(get_called_class());
    }
}
