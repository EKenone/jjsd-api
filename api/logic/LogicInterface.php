<?php


namespace api\logic;


interface LogicInterface
{
    /**
     * done公用接，执行方法
     * @return mixed
     */
    public function exec();

    /**
     * 获取需要返回的数据集合
     * @return array
     */
    public function getResult(): array;
}