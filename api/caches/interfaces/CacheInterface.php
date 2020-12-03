<?php


namespace api\caches\interfaces;


interface CacheInterface
{
    /**
     * 获取缓存数据
     * @return mixed
     */
    public function getData();

    /**
     * 设置缓存数据
     * @param $data
     * @return mixed
     */
    public function setData($data);

    /**
     * 删除缓存数据
     * @return mixed
     */
    public function delData();

    /**
     * 设置缓存分组标识
     * @param $group
     * @return mixed
     */
    public function setGroup($group);

    /**
     * 获取缓存分组标识
     * @return mixed
     */
    public function getGroup();

    /**
     * 缓存分组标识数据库字段
     * @return array
     */
    public function groupDbFields(): array ;
}