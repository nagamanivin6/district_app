<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%complaints_trans}}".
 *
 * @property integer $comp_transid
 * @property integer $comp_id
 * @property integer $comp_status
 * @property integer $comp_empregid
 * @property string $comp_date
 */
class ComplaintsTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%complaints_trans}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comp_id', 'comp_status', 'comp_empregid', 'comp_date'], 'required'],
            [['comp_id', 'comp_status', 'comp_empregid'], 'integer'],
            [['comp_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comp_transid' => Yii::t('app', 'Comp Transid'),
            'comp_id' => Yii::t('app', 'Comp ID'),
            'comp_status' => Yii::t('app', 'Comp Status'),
            'comp_empregid' => Yii::t('app', 'Comp Empregid'),
            'comp_date' => Yii::t('app', 'Comp Date'),
        ];
    }

    /**
     * @inheritdoc
     * @return ComplaintsTransQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComplaintsTransQuery(get_called_class());
    }
}
