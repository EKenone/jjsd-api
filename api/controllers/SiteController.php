<?php
namespace api\controllers;

use api\components\Controller;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return array
     */
    public function actionIndex()
    {
        return ["ok"];
    }

    public function actionLogin()
    {
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();

        // Previous implementation
        /*
        $token = $jwt->getBuilder()
            ->setIssuer('http://example.com')// Configures the issuer (iss claim)
            ->setAudience('http://example.org')// Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
            ->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
            ->set('uid', 100)// Configures a new claim, called "uid"
            ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
            ->getToken(); // Retrieves the generated token
        */

        // Adoption for lcobucci/jwt ^4.0 version
        $token = $jwt->getBuilder()
            ->issuedBy(ArrayHelper::getValue(\Yii::$app->params, 'api_jwt_config.iss'))// Configures the issuer (iss claim)
            ->permittedFor(ArrayHelper::getValue(\Yii::$app->params, 'api_jwt_config.aud'))// Configures the audience (aud claim)
            ->identifiedBy(ArrayHelper::getValue(\Yii::$app->params, 'api_jwt_config.jit'), true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->expiresAt($time + 86400)// Configures the expiration time of the token (exp claim)
            ->withClaim('uid', 1)// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token

        return ['token'=>(string)$token];

    }
}
