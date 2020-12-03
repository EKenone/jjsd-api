<?php

namespace api\modules\shop\models\query;

use api\components\ActiveRecord;
use api\modules\shop\models\GoodsFormat;

/**
 * This is the ActiveQuery class for [[\api\modules\shop\models\GoodsFormat]].
 *
 * @see \api\modules\shop\models\GoodsFormat
 */
class GoodsFormatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GoodsFormat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GoodsFormat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param bool $type
     * @return $this
     */
    public function notDelete($type = true)
    {
        return $this->andWhere([GoodsFormat::withDatabaseName('is_del') => ($type ? ActiveRecord::IS_DEL_NO : ActiveRecord::IS_DEL_YES )]);
    }
}
