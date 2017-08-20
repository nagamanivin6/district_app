<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%leave_categories}}".
 *
 * @property integer $id
 * @property string $leave_category_name
 * @property integer $leave_category_status
 */
class LeaveCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%leave_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leave_category_name', 'leave_category_status'], 'required'],
            [['leave_category_status'], 'integer'],
            [['leave_category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'leave_category_name' => Yii::t('app', 'Leave Category Name'),
            'leave_category_status' => Yii::t('app', 'Leave Category Status'),
        ];
    }
}
