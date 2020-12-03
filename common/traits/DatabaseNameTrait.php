<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/19
 * Time: 10:51
 */
namespace common\traits;

/**
 * Class DatabaseNameTrait
 * @package common\traits
 *
 * 只适用于ActiveRecord
 */
trait DatabaseNameTrait
{
    /**
     * 返回字段完整名称，包含数据库名称
     * @param $attribute
     * @return string
     */
    public static function withDatabaseName($attribute)
    {
        $tableName = static::tableName();

        return "{$tableName}.{$attribute}";
    }
}