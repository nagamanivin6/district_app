<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Mandal]].
 *
 * @see Mandal
 */
class MandalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Mandal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Mandal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
