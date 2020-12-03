<?php

namespace api\modules\admin\models;

use api\components\ActiveRecord;
use api\modules\admin\models\query\AdminRoleQuery;
use Yii;

/**
 * This is the model class for table "sd_admin_role".
 *
 * @property int $id
 * @property int $admin_id 管理员ID
 * @property int $role_id 角色ID
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 */
class AdminRole extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_admin_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'role_id', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => '管理员ID',
            'role_id' => '角色ID',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AdminRoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdminRoleQuery(get_called_class());
    }
}
