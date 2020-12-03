<?php


namespace api\modules\shop\controllers;


use api\components\Controller;
use api\modules\shop\services\OrderService;
use yii\base\Exception;
use yii\base\UserException;

/**
 * Class OrderController
 * @package api\modules\shop\controllers
 *
 * @property OrderService $service
 */
class OrderController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = OrderService::class;

    /**
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {
        return $this->service->index(\Yii::$app->request->get());
    }

    /**
     * @return mixed
     * @throws UserException
     */
    public function actionDestroy()
    {
        return $this->service->destroy(\Yii::$app->request->post());
    }

    /**
     * @return mixed
     * @throws Exception
     * @throws UserException
     */
    public function actionCreate()
    {
        return $this->service->create(\Yii::$app->request->post());
    }

    /**
     * @return mixed
     * @throws Exception
     * @throws UserException
     */
    public function actionChangeStatus()
    {
        return $this->service->changeStatus(\Yii::$app->request->post());
    }

    /**
     * @return mixed
     * @throws UserException
     */
    public function actionBookGoods()
    {
        return $this->service->bookGoods(\Yii::$app->request->post());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionBookList()
    {
        return $this->service->bookList(\Yii::$app->request->get());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionBookClear()
    {
        return $this->service->bookClear(\Yii::$app->request->post());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionBookShow()
    {
        return $this->service->bookShow(\Yii::$app->request->get());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionBookUpdate()
    {
        return $this->service->bookUpdate(\Yii::$app->request->post());
    }
}