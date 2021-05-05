<?php


namespace api\modules\shop\controllers;


use api\components\Controller;
use api\modules\shop\services\CustomerService;
use yii\base\UserException;

/**
 * Class CustomerController
 * @package  api\modules\shop\controllers
 *
 * @property CustomerService $service
 */
class CustomerController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = CustomerService::class;

    /**
     * 客户列表
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {
        return $this->service->index(\Yii::$app->request->get());
    }

    /**
     * 添加客户
     * @return mixed
     * @throws UserException
     */
    public function actionStore()
    {
        return $this->service->createCustomerAndAddress(\Yii::$app->request->post());
    }

    /**
     * 更新客户
     * @return mixed
     * @throws UserException
     */
    public function actionUpdate()
    {
        return $this->service->update(\Yii::$app->request->post());
    }

    /**
     * 客户详情
     * @param $id
     * @return mixed
     * @throws UserException
     */
    public function actionShow($id)
    {
        return $this->service->show($id);
    }

    /**
     * 通用删除接口
     * @return mixed
     * @throws UserException
     */
    public function actionDestroy()
    {
        return $this->service->destroy(\Yii::$app->request->post());
    }
}