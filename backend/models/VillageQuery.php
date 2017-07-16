<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Village]].
 *
 * @see Village
 */
class VillageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Village[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Village|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
