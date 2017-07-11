<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%complaints_master}}".
 *
 * @property integer $comp_id
 * @property string $comp_desc
 * @property integer $issue_id
 * @property integer $user_regid
 * @property string $created_date
 * @property integer $status
 */
class Complaints extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%complaints_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comp_desc', 'issue_id', 'user_regid', 'created_date', 'status'], 'required'],
            [['issue_id', 'user_regid', 'status'], 'integer'],
            [['created_date'], 'safe'],
            [['comp_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comp_id' => Yii::t('app', 'Comp ID'),
            'comp_desc' => Yii::t('app', 'Comp Desc'),
            'issue_id' => Yii::t('app', 'Issue ID'),
            'user_regid' => Yii::t('app', 'User Regid'),
            'created_date' => Yii::t('app', 'Created Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return ComplaintsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComplaintsQuery(get_called_class());
    }
}
