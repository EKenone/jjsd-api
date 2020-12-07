<?php

namespace api\modules\shop\models\query;

use api\components\ActiveRecord;
use api\modules\shop\models\GoodsShelfLife;

/**
 * This is the ActiveQuery class for [[\api\modules\shop\models\GoodsShelfLife]].
 *
 * @see \api\modules\shop\models\GoodsShelfLife
 */
class GoodsShelfLifeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GoodsShelfLife[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GoodsShelfLife|array|null
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
        return $this->andWhere([GoodsShelfLife::withDatabaseName('is_del') => ($type ? ActiveRecord::IS_DEL_NO : ActiveRecord::IS_DEL_YES)]);
    }
}
