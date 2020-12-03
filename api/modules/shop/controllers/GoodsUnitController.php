<?php


namespace api\modules\shop\controllers;


use api\components\Controller;
use api\modules\shop\services\GoodsUnitService;
use yii\base\UserException;

/**
 * Class GoodsUnitController
 * @package api\modules\shop\controllers
 *
 * @property GoodsUnitService $service
 */
class GoodsUnitController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = GoodsUnitService::class;

    /**
     * 商品单位列表
     * @return mixed
     * @throws UserException
     */
    public function actionIndex()
    {
        return $this->service->index(\Yii::$app->request->get());
    }

    /**
     * 添加商品单位
     * @return mixed
     * @throws UserException
     */
    public function actionStore()
    {
        return $this->service->store(\Yii::$app->request->post());
    }

    /**
     * 更新商品单位
     * @return mixed
     * @throws UserException
     */
    public function actionUpdate()
    {
        return $this->service->update(\Yii::$app->request->post());
    }

    /**
     * 商品单位详情
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

    /**
     * @return array
     */
    public function actionSelect()
    {
        return $this->service->select();
    }
}