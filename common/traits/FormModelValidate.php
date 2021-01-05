<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019/7/10
 * Time: 16:54
 */

namespace common\traits;


use yii\base\UserException;
use common\helpers\BaseHelper;
use common\helpers\ValidatorHelper;
use yii\helpers\ArrayHelper;


/**
 * Trait FormModelValidate
 * @package common\traits
 *
 * @api strCommaArr
 */
trait FormModelValidate
{
    /**
     * 特定验证属性
     * @param $attr
     */
    public function validateAttr($attr)
    {
        $method = 'validate' . BaseHelper::convertUnderline($attr, true);
        if (method_exists(get_called_class(), $method)) {
            $this->$method();
        }
    }

    /**
     * 特定验证公用标识
     * @return string
     */
    public function validateMethod()
    {
        return 'validateAttr';
    }

    /**
     * @param $attr
     */
    public function uniqNotDel($attr)
    {
        if ($this->$attr && self::find()->notDelete()->andWhere([$attr => $this->$attr])->andFilterWhere(['<>', 'id', $this->id])->exists()) {
            $this->addError($attr, $this->getAttributeLabel($attr) . '已存在');
        }
    }

    /**
     * 时间字符串转换时间戳
     * @param $attr
     */
    public function dateToTime($attr)
    {
        $this->$attr = $this->$attr ? strtotime($this->$attr) : '';
    }

    /**
     * 逗号分隔的字符串转换成数组
     * @param $attr
     */
    public function strCommaArr($attr)
    {
        $this->$attr = explode(',', $this->$attr);
    }

    /**
     * 获取url的path部分
     * @param $attr
     */
    public function urlToPath($attr)
    {
        $path = ltrim(parse_url($this->$attr, PHP_URL_PATH), '/');
        $this->$attr = (string)$path;
    }

    /**
     * 元单位金额转换为分
     * @param $attr
     * @return float|int
     */
    public function yuanToPenny($attr)
    {
        return $this->$attr = $this->$attr * 100;
    }

    /**
     * 验证手机号
     * @param $attr
     */
    public function checkPhone($attr)
    {
        if (!ValidatorHelper::isMobile($this->$attr)) {
            $this->addError($attr, '请输入正确手机号');
        }
    }

    /**
     * 验证固话
     * @param $attr
     */
    public function checkLocNumber($attr)
    {
        if (!ValidatorHelper::isPhone($this->$attr)) {
            $this->addError($attr, '请输入正确固话');
        }
    }

    public function checkWxId($attr)
    {
        if (!ValidatorHelper::isWechatId($this->$attr)) {
            $this->addError($attr, '请输入正确微信号');
        }
    }

    /**
     * 去除金额的千分符
     * @param $attr
     */
    public function removeCashSign($attr)
    {
        $this->$attr = str_replace(',', '', $this->$attr);
    }

    /**
     * 规定好的排序格式转义
     * @param $attr
     */
    public function sortValToArr($attr)
    {
        if ($this->$attr) {
            $sortArr = [];
            $arr = explode(',', $this->$attr);
            \Yii::error($arr);
            foreach ($arr as $item) {
                $val = explode('_', $item);
                $sortArr[$val[0]] = $val[1] == 'asc' ? SORT_ASC : SORT_DESC;
            }
            $this->$attr = $sortArr;
        }
    }
}