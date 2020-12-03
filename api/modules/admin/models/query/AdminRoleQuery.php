<?php

namespace api\modules\admin\models\query;

use api\components\ActiveRecord;
use api\modules\admin\models\AdminRole;

/**
 * This is the ActiveQuery class for [[\api\modules\admin\models\AdminRole]].
 *
 * @see \api\modules\admin\models\AdminRole
 */
class AdminRoleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AdminRole[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AdminRole|array|null
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
        return $this->andWhere([AdminRole::withDatabaseName('is_del') => ($type ? ActiveRecord::IS_DEL_NO : ActiveRecord::IS_DEL_YES )]);
    }
}
