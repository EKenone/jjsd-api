<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019/12/13
 * Time: 20:16
 */

namespace common\helpers;


use yii\redis\Mutex;

class ComplicateHelp
{
    /**
     * 简单的加锁
     * @param $lockKey
     * @param int $timeout 锁多长时间
     * @param int $expire 锁的过期时间
     * @param string $keyPrefix key前缀
     * @return bool
     */
    public static function lock($lockKey, $timeout = 10, $expire = 0, $keyPrefix = '')
    {
        $config = [
            'class' => Mutex::class,
            'keyPrefix' => $keyPrefix,
        ];
        if ($expire) {
            $config['expire'] = $expire;
        }
        \Yii::$app->setComponents([
            'mutex' => $config
        ]);

        return \Yii::$app->mutex->acquire($lockKey, $timeout);
    }

    /**
     * 解锁
     * @param $lockKey
     */
    public static function unlock($lockKey)
    {
        \Yii::$app->mutex->release($lockKey);
    }

    /**
     * 加锁并且释放锁
     * @param \Closure $func
     * @param string $lockKey 锁的key
     * @param int $timeout 锁多长时间
     * @param int $expire 锁的过期时间
     * @param string $keyPrefix key前缀
     * @return mixed
     */
    public static function lockAndFree(\Closure $func, $lockKey, $timeout = 10, $expire = 0, $keyPrefix = '')
    {
        self::lock($lockKey, $timeout, $expire, $keyPrefix);
        $res = $func();
        self::unlock($lockKey);
        return $res;
    }
}