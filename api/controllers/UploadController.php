<?php


namespace api\controllers;


use api\components\Controller;
use api\services\UploadService;

/**
 * Class UploadController
 * @package api\controllers
 *
 * @property UploadService $service
 */
class UploadController extends Controller
{
    /**
     * @var string
     */
    public $serviceClass = UploadService::class;

    /**
     * @return string[]|\yii\base\DynamicModel
     * @throws \yii\base\Exception
     * @throws \yii\base\UserException
     */
    public function actionUploadImg()
    {
        return $this->service->uploadImg(\Yii::$app->request->get());
    }
}