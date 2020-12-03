<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'api\modules\admin\Module',
        ],
        'shop' => [
            'class' => 'api\modules\shop\Module',
        ],
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'as format' => 'common\behaviors\ResponseFormatBehavior',
        ],
        'jwt' => [
            'class' => 'sizeg\jwt\Jwt',
            'key'   => 'secret',
            // You have to configure ValidationData informing all claims you want to validate the token.
            'jwtValidationData' => 'api\components\JwtValidationData'
        ],
        'user' => [
            'identityClass' => 'api\resources\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'jjsd-api',
            'class' => 'yii\redis\Session',
            'timeout' => 86400 * 7 * 30,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
