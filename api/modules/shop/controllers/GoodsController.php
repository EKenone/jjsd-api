<?php


namespace api\modules\shop\controllers;


use api\components\Controller;
use api\modules\shop\services\GoodsService;
use yii\base\UserException;

/**
 * Class GoodsController
 * @package api\modules\shop\controllers
 *
 * @property GoodsService $service
 */
class GoodsController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = GoodsService::class;

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