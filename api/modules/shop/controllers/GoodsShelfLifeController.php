<?php


namespace api\modules\shop\controllers;


use api\modules\shop\services\GoodsShelfLifeService;
use yii\base\UserException;

/**
 * Class GoodsFormatController
 * @package api\modules\shop\controllers
 *
 * @property GoodsShelfLifeService $service
 */
class GoodsShelfLifeController extends \api\components\Controller
{
    /**
     * @var string
     */
    public $serviceClass = GoodsShelfLifeService::class;

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
    public function actionStore()
    {
        return $this->service->store(\Yii::$app->request->post());
    }

    /**
     * @return mixed
     * @throws UserException
     */
    public function actionUpdate()
    {
        return $this->service->update(\Yii::$app->request->post());
    }

    /**
     * @return mixed
     * @throws UserException
     */
    public function actionDestroy()
    {
        return $this->service->destroy(\Yii::$app->request->post());
    }
}