<?php

namespace api\modules\admin\models\query;

use api\components\ActiveRecord;
use api\modules\admin\models\Admin;

/**
 * This is the ActiveQuery class for [[\api\modules\admin\\models\Admin]].
 *
 * @see \api\modules\admin\\models\Admin
 */
class AdminQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Admin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Admin|array|null
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
        return $this->andWhere([Admin::withDatabaseName('is_del') => ($type ? ActiveRecord::IS_DEL_NO : ActiveRecord::IS_DEL_YES )]);
    }
}
