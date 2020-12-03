<?php

namespace api\modules\admin\models;

use api\components\ActiveRecord;
use api\modules\admin\models\query\RolePermissionQuery;
use Yii;

/**
 * This is the model class for table "sd_admin_role_permission".
 *
 * @property int $id
 * @property int $role_id 角色ID
 * @property int $menu_id 菜单ID
 * @property int $is_del 是否删除（0-否，1-是）
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Menu $menu
 *
 */
class RolePermission extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sd_role_permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'menu_id', 'is_del', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => '角色ID',
            'menu_id' => '菜单ID',
            'is_del' => '是否删除（0-否，1-是）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RolePermissionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RolePermissionQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::class, ['id' => 'menu_id']);
    }
}
