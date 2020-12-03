<?php


namespace api\components;

use sizeg\jwt\JwtValidationData as BaseJwtValidationData;
use yii\helpers\ArrayHelper;

class JwtValidationData extends BaseJwtValidationData
{
    /**
     * @throws \Exception
     */
    public function init()
    {
        $this->validationData->setIssuer(ArrayHelper::getValue(\Yii::$app->params, 'api_jwt_config.iss'));
        $this->validationData->setAudience(ArrayHelper::getValue(\Yii::$app->params, 'api_jwt_config.aud'));
        $this->validationData->setId(ArrayHelper::getValue(\Yii::$app->params, 'api_jwt_config.jit'));

        parent::init();
    }
}