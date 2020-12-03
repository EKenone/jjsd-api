<?php


namespace api\modules\admin\controllers;


use api\components\Controller;
use api\modules\admin\forms\AdminForm;
use api\modules\admin\services\AdminService;
use yii\base\UserException;

/**
 * Class AdminController
 * @package api\modules\admin\controllers
 *
 * @property AdminService $service
 */
class AdminController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = AdminService::class;

    /**
     * 管理员列表
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {
        return $this->service->index(\Yii::$app->request->get());
    }

    /**
     * 添加管理员
     * @return mixed
     * @throws UserException
     */
    public function actionStore()
    {
        return $this->service->store(\Yii::$app->request->post());
    }

    /**
     * 更新管理员
     * @return mixed
     * @throws UserException
     */
    public function actionUpdate()
    {
        return $this->service->update(\Yii::$app->request->post());
    }

    /**
     * 管理员详情
     * @param $id
     * @return mixed
     * @throws UserException
     */
    public function actionShow($id)
    {
        return $this->service->show($id);
    }

    /**
     * 删除管理员
     * @return mixed
     * @throws UserException
     */
    public function actionDestroy()
    {
        return $this->service->destroy(\Yii::$app->request->post());
    }

    /**
     * 登录
     * @return AdminForm|array
     * @throws UserException
     */
    public function actionLogin()
    {
        return $this->service->login(\Yii::$app->request->post());
    }

    /**
     * @return array
     */
    public function actionLogout()
    {
        return $this->service->logout();
    }
}