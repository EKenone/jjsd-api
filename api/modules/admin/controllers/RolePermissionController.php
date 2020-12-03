<?php


namespace api\modules\admin\controllers;


use api\components\Controller;
use api\modules\admin\services\RolePermissionService;
use api\resources\User;

/**
 * Class AdminRolePermissionController
 * @package api\modules\admin\controllers
 *
 * @property RolePermissionService $service
 */
class RolePermissionController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = RolePermissionService::class;

    /**
     * 创建角色权限
     * @return mixed
     * @throws \yii\base\UserException
     */
    public function actionBatchCreate()
    {
        return $this->service->batchCreate(\Yii::$app->request->post());
    }

    /**
     * 获取角色拥有的菜单权限
     * @param $id
     * @return array
     */
    public function actionRolePermissionMenu($id)
    {
        return $this->service->rolePermissionMenu($id);
    }

    /**
     * @return array
     */
    public function actionAdminRoleMenu()
    {
        /** @var User $admin */
        $admin = \Yii::$app->user->identity;
        return $this->service->adminRoleMenu($admin->adminRoleIds());
    }
}