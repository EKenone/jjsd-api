<?php


namespace common\helpers;


class ValidatorHelper
{
    /** 验证电话号码
     * @param $string string
     * @return boolean
     */
    public static function isPhone($string)
    {
        if (empty($string)) {
            return false;
        }
        $exp = "/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/";
        return preg_match($exp, $string);
    }

    /** 验证手机
     * @param $string string
     * @return boolean
     */
    public static function isMobile($string)
    {
        if (empty($string)) {
            return false;
        }
        $exp = '#^1[1-9][\d]{9}$#';
        return preg_match($exp, $string);
    }

    /** 验证微信号
     * @param $string string
     * @return boolean
     */
    public static function isWechatId($string)
    {
        if (empty($string)) {
            return false;
        }
        $exp = "/^[-_a-zA-Z0-9]{5,32}+$/";
        return preg_match($exp, $string);
    }
}