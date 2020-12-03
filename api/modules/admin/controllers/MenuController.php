<?php


namespace api\modules\admin\controllers;


use api\components\Controller;
use api\modules\admin\services\MenuService;
use yii\base\UserException;

/**
 * Class MenuController
 * @package api\modules\admin\controllers
 *
 * @property MenuService $service
 */
class MenuController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = MenuService::class;

    /**
     * 菜单列表
     * @return mixed
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

    /**
     * 菜单选择
     * @return array
     */
    public function actionSelect()
    {
        return $this->service->select();
    }
}