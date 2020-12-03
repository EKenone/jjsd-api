<?php

namespace api\modules\shop\models\query;

use api\components\ActiveRecord;
use api\modules\shop\models\GoodsUnit;

/**
 * This is the ActiveQuery class for [[\api\modules\shop\models\GoodsUnit]].
 *
 * @see \api\modules\shop\models\GoodsUnit
 */
class GoodsUnitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GoodsUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GoodsUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * 非删除数据
     * @param bool $type
     * @return $this
     */
    public function notDelete($type = true)
    {
        return $this->andWhere([GoodsUnit::withDatabaseName('is_del') => ($type ? ActiveRecord::IS_DEL_NO : ActiveRecord::IS_DEL_YES)]);
    }
}
