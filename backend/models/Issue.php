<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%issue_master}}".
 *
 * @property integer $issue_id
 * @property string $issue_desc
 * @property string $issue_desctel
 * @property integer $issue_priority
 * @property integer $dept_id
 * @property integer $issue_status
 */
class Issue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%issue_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issue_desc', 'issue_desctel', 'issue_priority', 'dept_id', 'issue_status'], 'required'],
            [['issue_priority', 'dept_id', 'issue_status'], 'integer'],
            [['issue_desc', 'issue_desctel'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'issue_id' => Yii::t('app', 'Issue ID'),
            'issue_desc' => Yii::t('app', 'Issue Desc'),
            'issue_desctel' => Yii::t('app', 'Issue Desctel'),
            'issue_priority' => Yii::t('app', 'Issue Priority'),
            'dept_id' => Yii::t('app', 'Dept ID'),
            'issue_status' => Yii::t('app', 'Issue Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return IssueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IssueQuery(get_called_class());
    }
}
