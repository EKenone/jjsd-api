<?php


namespace api\modules\admin\resources;


use api\modules\admin\models\RolePermission;

class RolePermissionResource extends RolePermission
{
    const ADMIN_ROLE_MENU = 'admin_role_menu';

    public function fieldAdminRoleMenu()
    {
        return [
            'id' => function () {
                return (int)$this->menu_id;
            },
            'title' => function () {
                return $this->menu->title;
            },
            'pid' => function () {
                return (int)$this->menu->pid;
            },
            'icon' => function () {
                return $this->menu->icon;
            },
            'path' => function () {
                return $this->menu->path;
            }
        ];
    }
}