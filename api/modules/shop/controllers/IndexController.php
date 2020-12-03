<?php


namespace api\modules\shop\controllers;


use api\components\Controller;
use api\modules\shop\services\IndexService;

/**
 * Class IndexController
 * @package api\modules\shop\controllers
 *
 * @property IndexService $service
 */
class IndexController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = IndexService::class;

    public function actionHome()
    {
        return $this->service->home();
    }
}