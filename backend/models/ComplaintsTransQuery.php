<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ComplaintsTrans]].
 *
 * @see ComplaintsTrans
 */
class ComplaintsTransQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ComplaintsTrans[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ComplaintsTrans|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
