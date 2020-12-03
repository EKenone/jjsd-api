<?php


namespace api\modules\admin\controllers;


use api\components\Controller;
use api\modules\admin\services\RoleService;
use yii\base\UserException;

/**
 * Class AdminRoleController
 * @package api\modules\admin\controllers
 *
 * @property RoleService $service
 */
class RoleController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = RoleService::class;

    /**
     * 管理角色列表
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {
        return $this->service->index(\Yii::$app->request->get());
    }

    /**
     * 添加管理角色
     * @return mixed
     * @throws UserException
     */
    public function actionStore()
    {
        return $this->service->store(\Yii::$app->request->post());
    }

    /**
     * 更新管理角色
     * @return mixed
     * @throws UserException
     */
    public function actionUpdate()
    {
        return $this->service->update(\Yii::$app->request->post());
    }

    /**
     * 删除角色
     * @return mixed
     * @throws UserException
     */
    public function actionDestroy()
    {
        return $this->service->destroy(\Yii::$app->request->post());
    }

}