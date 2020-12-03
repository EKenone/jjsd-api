<?php


namespace api\logic;


use common\helpers\ComplicateHelp;
use yii\base\Model;
use yii\base\UserException;

abstract class LogicAbstract extends Model implements LogicInterface
{

    /**
     * @var array 需要返回的数据集合
     */
    protected $result;

    /**
     * 把错误都捕捉到模型的error对象里面，可以返回对象再做错误处理
     * @param $msg
     */
    protected function err($msg)
    {
        $this->addError(self::class, $msg);
    }

    /**
     * 并发锁的key，用于业务结束后释放
     * @var array
     */
    protected $lockKey = [];

    /**
     * 释放并发
     */
    protected function freedLock(): void
    {
        foreach ($this->lockKey as $key) {
            ComplicateHelp::unlock($key);
        }
    }

    /**
     * 加并发锁
     * @param $lockKey
     * @param int $timeout
     * @param int $expire
     */
    protected function addLock($lockKey, $timeout = 10, $expire = 0): void
    {
        ComplicateHelp::lock($lockKey, $timeout, $expire, 'API:BROKER:LOGIC:');
        $this->lockKey[] = $lockKey;
    }

    /**
     * 表单模型错误debug
     * @param Model $form
     * @param string $msg
     * @throws UserException
     */
    protected function modelThrowErr($form, $msg = ''): void
    {
        \Yii::error($form->getFirstErrors());
        throw new UserException($msg ?: current($form->getFirstErrors()));
    }

    /**
     * 获取需要返回的数据集合
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * done公用接
     * @return $this
     */
    final public function done(): LogicInterface
    {
        $this->exec();

        // 释放锁
        if (!empty($this->lockKey)) {
            $this->freedLock();
        }

        return $this;
    }

    /**
     * 实现所有运行逻辑的方法
     * @return mixed
     */
    abstract public function exec();
}