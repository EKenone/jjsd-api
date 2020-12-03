<?php


namespace api\modules\shop\controllers;


use api\components\Controller;
use api\modules\shop\services\OrderGoodsService;

/**
 * Class OrderGoodsController
 * @package api\modules\shop\controllers
 *
 * @property OrderGoodsService $service
 */
class OrderGoodsController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = OrderGoodsService::class;

    /**
     * @return mixed
     * @throws \yii\base\UserException
     */
    public function actionIndex()
    {
        return $this->service->index(\Yii::$app->request->get());
    }

}