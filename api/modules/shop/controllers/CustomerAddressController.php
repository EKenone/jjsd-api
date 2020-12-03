<?php


namespace api\modules\shop\controllers;


use api\components\Controller;
use api\modules\shop\services\CustomerAddressService;
use yii\base\UserException;

/**
 * Class CustomerAddressController
 * @package api\modules\shop\controllers
 *
 * @property CustomerAddressService $service
 */
class CustomerAddressController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = CustomerAddressService::class;

    /**
     * 商品列表
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {
        return $this->service->index(\Yii::$app->request->get());
    }

    /**
     * 添加商品
     * @return mixed
     * @throws UserException
     */
    public function actionStore()
    {
        return $this->service->store(\Yii::$app->request->post());
    }

    /**
     * 更新商品
     * @return mixed
     * @throws UserException
     */
    public function actionUpdate()
    {
        return $this->service->update(\Yii::$app->request->post());
    }

    /**
     * 商品详情
     * @param $id
     * @return mixed
     * @throws UserException
     */
    public function actionShow($id)
    {
        return $this->service->show($id);
    }

    /**
     * 商品删除接口
     * @return mixed
     * @throws UserException
     */
    public function actionDestroy()
    {
        return $this->service->destroy(\Yii::$app->request->post());
    }
}