<?php


namespace api\modules\admin\forms;


use api\modules\admin\models\RolePermission;

class RolePermissionForm extends RolePermission
{
    const BATCH_CREATE = 'batch_create';

    public $menu_ids;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['role_id', 'menu_id'], 'required'],
            [['menu_ids'], 'safe']
        ];
    }

    /**
     * @return array|array[]
     */
    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            self::SCENARIO_STORE => ['role_id', 'menu_id'],
            self::BATCH_CREATE => ['role_id', 'menu_ids'],
        ]); // TODO: Change the autogenerated stub
    }
}