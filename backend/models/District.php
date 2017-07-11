<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "district_master".
 *
 * @property integer $dist_id
 * @property string $dist_name
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dist_name'], 'required'],
            [['dist_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dist_id' => 'Dist ID',
            'dist_name' => 'Dist Name',
        ];
    }
}
