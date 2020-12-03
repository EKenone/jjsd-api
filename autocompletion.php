<?php

/**
 * 用于增强IDE代码自动完成。
 * 使用方式：右键(vendor/yiisoft/yii2/Yii.php) -> "Mark as Plain Text"
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|ConsoleApplication the application instance
     */
    public static $app;
}

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property \sizeg\jwt\Jwt $jwt
 * @property \yii\redis\Connection $redis
 * @property \yii\elasticsearch\Connection $elasticsearch
 */
abstract class BaseApplication extends yii\base\Application
{
}


/**
 * Class ConsoleApplication
 * Include only Console application related components here
 */
class ConsoleApplication extends yii\console\Application
{
}

/**
 * @property \api\resources\User|yii\web\IdentityInterface|null $identity
 */
class User extends \yii\web\User
{

}
