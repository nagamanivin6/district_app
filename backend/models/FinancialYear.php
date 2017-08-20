<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%financial_year_master}}".
 *
 * @property integer $id
 * @property string $financial_year_name
 * @property integer $financial_year_status
 */
class FinancialYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%financial_year_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['financial_year_name', 'financial_year_status'], 'required'],
            [['financial_year_status'], 'integer'],
            [['financial_year_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'financial_year_name' => Yii::t('app', 'Financial Year Name'),
            'financial_year_status' => Yii::t('app', 'Financial Year Status'),
        ];
    }
}
