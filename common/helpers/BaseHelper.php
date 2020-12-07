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

    /**
     * 阿拉伯金额转换成中文金额
     * @param $amount
     * @param int $type
     * @return string
     */
    public static function convertAmountToChn($amount, $type = 0) {
        // 判断输出的金额是否为数字或数字字符串
        if(!is_numeric($amount)){
            return "要转换的金额只能为数字!";
        }

        // 金额为0,则直接输出"零元整"
        if($amount == 0) {
            return "人民币零元整";
        }

        // 金额不能为负数
        if($amount < 0) {
            return "要转换的金额不能为负数!";
        }

        // 金额不能超过万亿,即12位
        if(strlen($amount) > 12) {
            return "要转换的金额不能为万亿及更高金额!";
        }

        // 预定义中文转换的数组
        $digital = array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
        // 预定义单位转换的数组
        $position = array('仟', '佰', '拾', '亿', '仟', '佰', '拾', '万', '仟', '佰', '拾', '元');

        // 将金额的数值字符串拆分成数组
        $amountArr = explode('.', $amount);

        // 将整数位的数值字符串拆分成数组
        $integerArr = str_split($amountArr[0], 1);

        // 将整数部分替换成大写汉字
        $result = '';
        $integerArrLength = count($integerArr);     // 整数位数组的长度
        $positionLength = count($position);         // 单位数组的长度
        $zeroCount = 0;                             // 连续为0数量
        for($i = 0; $i < $integerArrLength; $i++) {
            // 如果数值不为0,则正常转换
            if($integerArr[$i] != 0){
                // 如果前面数字为0需要增加一个零
                if($zeroCount >= 1){
                    $result .= $digital[0];
                }
                $result .= $digital[$integerArr[$i]] . $position[$positionLength - $integerArrLength + $i];
                $zeroCount = 0;
            }else{
                $zeroCount += 1;
                // 如果数值为0, 且单位是亿,万,元这三个的时候,则直接显示单位
                if(($positionLength - $integerArrLength + $i + 1)%4 == 0){
                    $result = $result . $position[$positionLength - $integerArrLength + $i];
                }
            }
        }

        // 如果小数位也要转换
        if($type == 0) {
            // 将小数位的数值字符串拆分成数组
            $decimalArr = str_split($amountArr[1], 1);
            // 将角替换成大写汉字. 如果为0,则不替换
            if($decimalArr[0] != 0){
                $result = $result . $digital[$decimalArr[0]] . '角';
            }
            // 将分替换成大写汉字. 如果为0,则不替换
            if($decimalArr[1] != 0){
                $result = $result . $digital[$decimalArr[1]] . '分';
            }
        }else{
            $result = $result . '整';
        }
        return $result;

    }
}