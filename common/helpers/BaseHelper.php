<?php


namespace common\helpers;


class BaseHelper
{
    /**
     * @desc 下划线分割的字符串转为驼峰法
     * @param $string string
     * @param $first boolean
     * @return string
     */
    public static function convertUnderline($string, $first = false)
    {
        if (FALSE === strpos($string, '_')) {
            return $string;
        }

        $string = ucwords(str_replace('_', ' ', $string));
        $string = str_replace(' ', '', lcfirst($string));
        return $first ? ucfirst($string) : $string;
    }

    /**
     * 分单位转化成元
     * @param $penny
     * @param bool $decimal
     * @return float|int
     */
    public static function pennyToYuan($penny, $decimal = true)
    {
        $yuan = $penny / 100;
        if ($decimal) {
            $yuan = number_format($yuan, 2);
        }
        return $yuan;
    }

    /**
     * 树形结构
     * @param $data
     * @param string $idKey
     * @param string $pidKey
     * @param string $childKey
     * @param int $rootId
     * @return array
     */
    public static function tree($data, $idKey = 'id', $pidKey = 'pid', $childKey = 'children', $rootId = 0)
    {
        $tree = [];
        //第一步，将分类id作为数组key,并创建children单元
        foreach ($data as $item) {
            $tree[$item[$idKey]] = $item;
        }

        //第二步，利用引用，将每个分类添加到父类children数组中，这样一次遍历即可形成树形结构。
        foreach ($tree as $key => $item) {
            if ($item[$pidKey] != $rootId) {
                $tree[$item[$pidKey]][$childKey][] = &$tree[$key];//注意：此处必须传引用否则结果不对
            }
        }

        // 第三步，删除无用的非根节点数据
        foreach ($tree as $key => $category) {
            if ($category[$pidKey] != $rootId) {
                unset($tree[$key]);
            }
        }
        return $tree;
    }
}