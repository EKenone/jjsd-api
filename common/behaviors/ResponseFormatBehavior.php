<?php

namespace common\behaviors;


use yii\base\Behavior;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class ResponseFormatBehavior extends Behavior
{
    /**
     * @return array|string[]
     */
    public function events()
    {
        return [
            Response::EVENT_BEFORE_SEND => 'formatResponse'
        ];
    }

    /**
     * @param $event
     * @throws \Exception
     */
    public function formatResponse($event)
    {


        $request = \Yii::$app->request;

        /* @var $response Response */
        $response = $event->sender;
        if ($response->data !== null && is_array($response->data)) {
            if ($response->isSuccessful) {// 成功
                $this->ok($response);
            } else if ($response->isNotFound) {
                $this->notFound($response);
            } else if ($response->statusCode == 422) {
                $this->modelValidateError($response);
            } else if ($response->statusCode == 401) {
                $this->authFail($response);
            } else {
                $this->systemErr($response);
            }

            if ($request->method == 'OPTIONS') {
                $response->statusCode = 200;
            }

            \Yii::info(ArrayHelper::toArray($response->data), 'response.data');
        }
        if($response->data == null) {
            $response->data = [
                'code' => 0,
                'msg' => 'ok',
                'data' => $response->data,
            ];
            $response->statusCode = 200;
        }
    }

    /**
     * 请求正常
     * @param Response $response
     * @throws \Exception
     */
    private function ok($response)
    {
        $response->data = [
            'code' => 200,
            'msg' => 'ok',
            'data' => $response->data,
        ];

        $response->statusCode = 200;
    }

    /**
     * 页面无法找到
     * @param Response $response
     * @throws \Exception
     */
    private function notFound($response)
    {
        $response->data = [
            'code' => 404,
            'msg' => \Yii::t('exception', ArrayHelper::getValue($response->data, 'message')),
            'data' => false,
        ];

        $response->statusCode = 200;
    }

    /**
     * model数据验证错误
     * @param Response $response
     * @throws \Exception
     */
    private function modelValidateError($response)
    {
        $response->data = [
            'code' => 422,
            'msg' => ArrayHelper::getValue($response->data, '0.message'),
            'data' => $response->data,
        ];

        $response->statusCode = 200;
    }

    /**
     * 授权失败
     * @param Response $response
     * @throws \Exception
     */
    private function authFail($response)
    {
        $response->data = [
            'code' => 401,
            'msg' => \Yii::t('exception', ArrayHelper::getValue($response->data, 'message')),
            'data' => false,
        ];

        $response->statusCode = 401;
    }

    /**
     * 系统错误
     * @param $response
     * @throws \Exception
     */
    private function systemErr($response)
    {
        //系统错误
        $response->data = [
            'code' => ArrayHelper::getValue($response->data, 'code') ?: $response->statusCode,
            'msg' => \Yii::t('exception', ArrayHelper::getValue($response->data, 'message')),
            'data' => false,
        ];

        $response->statusCode = 200;
    }

}